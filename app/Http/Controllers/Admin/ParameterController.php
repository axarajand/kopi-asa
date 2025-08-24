<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plantation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ParameterController extends Controller
{
    public function climate()
    {
        $plantations = Plantation::with('user')->whereNotNull('latitude')->whereNotNull('longitude')->get();
        return view('admin.parameters.climate', compact('plantations'));
    }

    public function topography()
    {
        $plantations = Plantation::with('user')->whereNotNull('latitude')->whereNotNull('longitude')->get();
        return view('admin.parameters.topography', compact('plantations'));
    }

    public function soil()
    {
        $plantations = Plantation::with('user')->whereNotNull('latitude')->whereNotNull('longitude')->get();
        return view('admin.parameters.soil', compact('plantations'));
    }

    public function fetchData(Request $request, $type)
    {
        $request->validate(['lat' => 'required|numeric', 'lon' => 'required|numeric']);
        $lat = (float) $request->lat;
        $lon = (float) $request->lon;

        try {
            switch ($type) {
                case 'climate':
                    $endDate = Carbon::now()->format('Y-m-d');
                    $startDate = Carbon::now()->subYear()->addDay()->format('Y-m-d');

                    $currentResp = Http::timeout(20)->get('https://api.open-meteo.com/v1/forecast', [
                        'latitude'  => $lat,
                        'longitude' => $lon,
                        'current'   => 'temperature_2m,relative_humidity_2m',
                    ]);

                    $temperature = null;
                    $rh = null;

                    if ($currentResp->successful() && isset($currentResp['current'])) {
                        $temperature = $currentResp['current']['temperature_2m'] ?? null;
                        $rh = $currentResp['current']['relative_humidity_2m'] ?? null;
                    } else {
                        $fallbackResp = Http::timeout(20)->get('https://api.open-meteo.com/v1/forecast', [
                            'latitude'        => $lat,
                            'longitude'       => $lon,
                            'current_weather' => true,
                            'hourly'          => 'relative_humidity_2m',
                            'past_days'       => 1,
                        ]);
                        if ($fallbackResp->successful()) {
                            $temperature = $fallbackResp['current_weather']['temperature'] ?? null;

                            if (isset($fallbackResp['hourly']['relative_humidity_2m'])) {
                                $rhArr = $fallbackResp['hourly']['relative_humidity_2m'];
                                $rh = is_array($rhArr) && count($rhArr) ? end($rhArr) : null;
                            }
                        }
                    }

                    $arcResp = Http::timeout(30)->get('https://archive-api.open-meteo.com/v1/archive', [
                        'latitude'  => $lat,
                        'longitude' => $lon,
                        'start_date'=> $startDate,
                        'end_date'  => $endDate,
                        'daily'     => 'precipitation_sum',
                        'timezone'  => 'auto',
                    ]);

                    $yearlyPrecip = null;
                    if ($arcResp->successful() && isset($arcResp['daily']['precipitation_sum'])) {
                        $yearlyPrecip = array_sum($arcResp['daily']['precipitation_sum']);
                    }

                    if ($temperature === null || $rh === null || $yearlyPrecip === null) {
                        return response()->json(['error' => 'Gagal mengambil data iklim'], 500);
                    }

                    return response()->json([
                        'Suhu' => round($temperature, 1) . ' °C',
                        'Kelembapan' => round($rh) . ' %',
                        'Curah Hujan (Total 1 Tahun Terakhir)' => round($yearlyPrecip) . ' mm',
                    ]);

                case 'topography':
                    $spacing = 0.001;
                    $grid = $this->build3x3Grid($lat, $lon, $spacing); 

                    $payload = ['locations' => array_map(function ($p) {
                        return ['latitude' => $p[0], 'longitude' => $p[1]];
                    }, $grid)];

                    $resp = Http::timeout(25)->post('https://api.open-elevation.com/api/v1/lookup', $payload);

                    if (!$resp->successful() || !isset($resp['results']) || count($resp['results']) < 9) {
                        return response()->json([
                            'Ketinggian (MDPL)' => 'Gagal',
                            'Kemiringan Lereng' => 'Gagal',
                            'Arah Lereng'       => 'Gagal',
                        ], 500);
                    }

                    $elev = array_map(fn($r) => (float) $r['elevation'], $resp['results']);
                    [$slopeDeg, $aspectDeg] = $this->computeSlopeAspectHorn($lat, $spacing, $elev);

                    $centerElevation = round($elev[4]);

                    if ($aspectDeg >= 337.5 || $aspectDeg < 22.5) $azimuth = "Utara";
                    if ($aspectDeg >= 22.5 && $aspectDeg < 67.5) $azimuth = "Timur Laut";
                    if ($aspectDeg >= 67.5 && $aspectDeg < 112.5) $azimuth = "Timur";
                    if ($aspectDeg >= 112.5 && $aspectDeg < 157.5) $azimuth = "Tenggara";
                    if ($aspectDeg >= 157.5 && $aspectDeg < 202.5) $azimuth = "Selatan";
                    if ($aspectDeg >= 202.5 && $aspectDeg < 247.5) $azimuth = "Barat Daya";
                    if ($aspectDeg >= 247.5 && $aspectDeg < 292.5) $azimuth = "Barat";
                    if ($aspectDeg >= 292.5 && $aspectDeg < 337.5) $azimuth = "Barat Laut";

                    return response()->json([
                        'Ketinggian (MDPL)' => $centerElevation . ' meter',
                        'Kemiringan Lereng' => round($slopeDeg, 1) . ' °',
                        'Arah Lereng'       => round($aspectDeg) . ' ° (' .$azimuth .')',
                    ]);

                case 'soil':
                    $base = 'https://rest.isric.org/soilgrids/v2.0/properties/query';

                    $props  = ['phh2o', 'sand', 'silt', 'clay', 'soc', 'bdod'];
                    $depths = ['0-5cm', '5-15cm'];
                    $values = ['mean'];

                    $query = http_build_query([
                        'lon' => $lon,
                        'lat' => $lat,
                    ], '', '&', PHP_QUERY_RFC3986);

                    foreach ($props as $p)  { $query .= '&property=' . rawurlencode($p); }
                    foreach ($depths as $d) { $query .= '&depth='    . rawurlencode($d); }
                    foreach ($values as $v) { $query .= '&value='    . rawurlencode($v); }

                    $url = $base . '?' . $query;

                    $response = Http::timeout(30)->get($url);
                    Log::info('SoilGrids API Response:', $response->json() ?? ['error' => 'No JSON response']);

                    if (!$response->successful() || !isset($response['properties']['layers'])) {
                        return response()->json(['error' => 'Gagal mengambil SoilGrids'], 500);
                    }

                    $layers = $response['properties']['layers'];

                    $getMeanAtTopDepth = function (string $name) use ($layers) {
                        foreach ($layers as $layer) {
                            if (($layer['name'] ?? null) === $name) {
                                $depths = $layer['depths'] ?? [];
                                if (!$depths) return null;
                                $vals = $depths[0]['values'] ?? [];
                                return $vals['mean'] ?? null; 
                            }
                        }
                        return null;
                    };

                    $phRaw  = $getMeanAtTopDepth('phh2o'); 
                    $sand   = $getMeanAtTopDepth('sand');  
                    $silt   = $getMeanAtTopDepth('silt'); 
                    $clay   = $getMeanAtTopDepth('clay'); 
                    $socRaw = $getMeanAtTopDepth('soc');   
                    $bdod   = $getMeanAtTopDepth('bdod'); 

                    $ph = is_numeric($phRaw) ? round($phRaw / 10, 1) : null;

                    $sandPct = is_numeric($sand) ? round(($sand / 10) / 10, 1) : null;
                    $siltPct = is_numeric($silt) ? round(($silt / 10) / 10, 1) : null;
                    $clayPct = is_numeric($clay) ? round(($clay / 10) / 10, 1) : null;

                    $socPct  = is_numeric($socRaw) ? round(($socRaw / 10) / 10, 2) : null; // %
                    $omPct   = is_numeric($socRaw) ? round($socPct * 1.724, 2) : null;     // %

                    $bd_gcm3 = is_numeric($bdod) ? round($bdod / 100, 2) : null;

                    $texture = 'Tidak Terdefinisi';
                    if ($sandPct !== null && $siltPct !== null && $clayPct !== null) {
                        if ($sandPct > 50 && $clayPct < 20)        $texture = 'Dominan Pasir';
                        elseif ($clayPct > 40)                     $texture = 'Dominan Liat';
                        elseif ($siltPct > 40 && $clayPct < 27)    $texture = 'Dominan Debu';
                        else                                       $texture = 'Lempung (Seimbang)';
                    }

                    $drainase = 'Tidak Terdefinisi';
                    if ($bd_gcm3 !== null) {
                        if ($bd_gcm3 > 1.6)      $drainase = 'Lambat (Padat)';
                        elseif ($bd_gcm3 < 1.2)  $drainase = 'Sangat Cepat (Gembur)';
                        else                     $drainase = 'Baik (Sedang)';
                    }

                    return response()->json([
                        'pH Tanah'        => $ph ?? 'N/A',
                        'Tekstur Tanah'   => $texture,
                        'Bahan Organik (%)' => $omPct !== null ? ($omPct . ' %') : 'N/A',
                        'Drainase'        => $drainase,
                    ]);
            }
        } catch (\Throwable $e) {
            Log::error('Parameter fetch error: '.$e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        }

        return response()->json(['error' => 'Tipe tidak dikenal'], 400);
    }

    private function build3x3Grid(float $lat, float $lon, float $spacing): array
    {
        $lats = [$lat + $spacing, $lat + $spacing, $lat + $spacing,
                 $lat,             $lat,             $lat,
                 $lat - $spacing,  $lat - $spacing,  $lat - $spacing];

        $lons = [$lon - $spacing, $lon, $lon + $spacing,
                 $lon - $spacing, $lon, $lon + $spacing,
                 $lon - $spacing, $lon, $lon + $spacing];

        $pts = [];
        for ($i = 0; $i < 9; $i++) {
            $pts[] = [$lats[$i], $lons[$i]];
        }
        return $pts;
    }

    private function computeSlopeAspectHorn(float $lat, float $spacingDeg, array $elevations): array
    {
        $deg2m_lat = 110540;
        $deg2m_lon = 111320 * cos(deg2rad($lat)); 
        $cellsizeX = $spacingDeg * $deg2m_lon;
        $cellsizeY = $spacingDeg * $deg2m_lat;

        [$z1,$z2,$z3,$z4,$z5,$z6,$z7,$z8,$z9] = $elevations;

        $dzdx = ( ($z3 + 2*$z6 + $z9) - ($z1 + 2*$z4 + $z7) ) / (8 * $cellsizeX);
        $dzdy = ( ($z7 + 2*$z8 + $z9) - ($z1 + 2*$z2 + $z3) ) / (8 * $cellsizeY);

        $slopeRad = atan( sqrt($dzdx*$dzdx + $dzdy*$dzdy) );
        $slopeDeg = rad2deg($slopeRad);

        $aspectRad = atan2($dzdy, -$dzdx);
        $aspectDeg = 90 - rad2deg($aspectRad);
        if ($aspectDeg < 0)   $aspectDeg += 360;
        if ($aspectDeg >= 360) $aspectDeg -= 360;

        return [$slopeDeg, $aspectDeg];
    }
    
    public function updateParameters(Request $request, Plantation $plantation)
    {
        $validated = $request->validate([
            'avg_temperature' => 'nullable|numeric',
            'avg_humidity' => 'nullable|numeric',
            'yearly_precipitation' => 'nullable|integer',
            'altitude' => 'nullable|integer',
            'slope_gradient' => 'nullable|numeric',
            'slope_aspect' => 'nullable|string',
            'soil_ph' => 'nullable|numeric',
            'soil_texture' => 'nullable|string',
            'organic_matter' => 'nullable|string',
            'drainage' => 'nullable|string',
        ]);
        
        $plantation->update($validated);
        
        return back()->with('success', 'Data parameter manual untuk kebun "' . $plantation->name . '" berhasil disimpan.');
    }
    
    public function saveApiData(Request $request, Plantation $plantation)
    {
        $plantation->update($request->all());

        return response()->json(['success' => true]);
    }
}
