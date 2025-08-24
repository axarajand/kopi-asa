<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plantation;
use App\Models\User;
use App\Models\Variety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class PredictionController extends Controller
{
    public function index()
    {
        $farmers = User::where('role', 'farmer')->orderBy('name')->get();
        $varieties = Variety::orderBy('name')->get();

        return view('admin.prediction.index', compact('farmers', 'varieties'));
    }

    public function predict(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:tb_users,id',
            'plantation_id' => 'required|exists:tb_plantations,id',
            'variety_id' => 'required|exists:tb_varieties,id',
            'processing_method' => 'required|string',
            'moisture' => 'required|numeric|min:0|max:1',
            'color' => 'required|string',
        ]);

        $plantation = Plantation::find($validated['plantation_id']);
        $variety = Variety::find($validated['variety_id']);

        $qualityPrediction = $this->getQualityScorePrediction($plantation, $variety, $validated['processing_method'], $validated['moisture'], $validated['color']);

        if ($qualityPrediction['status'] === "Gagal") {
            $phPrediction = "Gagal";
        } else {
            $phPrediction = $this->getPhPrediction($plantation, $variety, $validated['processing_method']);
        }

        $farmers = User::where('role', 'farmer')->orderBy('name')->get();
        $varieties = Variety::orderBy('name')->get();
        
        return view('admin.prediction.index', [
            'farmers' => $farmers,
            'varieties' => $varieties,
            'inputs' => $validated, 
            'qualityResult' => $qualityPrediction,
            'phResult' => $phPrediction,
        ]);
    }

    private function getQualityScorePrediction($plantation, $variety, $processingMethod, $moisture, $color)
    {
        $payload = [
            'altitude' => $plantation->altitude ?? 1200,
            'variety' => $variety->name ?? 'Unknown',
            'processing_method' => $processingMethod,
            'country' => 'Indonesia',
            'moisture' => $moisture, 
            'color' => $color,
        ];

        $response = Http::timeout(10)->post('http://127.0.0.1:5000/predict', $payload);

        if ($response->successful() && isset($response->json()['success']) && $response->json()['success']) {
            $score = (float)$response->json()['score'];
            return $this->getQualityDescription($score);
        }
        
        Log::error('Python API call failed: ' . $response->body());
        return ['status' => 'Gagal'];
    }
    
    private function getQualityDescription(float $score)
    {
        if ($score >= 90) {
            return ['status' => 'Sukses', 'score' => $score, 'description' => 'Luar Biasa (Outstanding)', 'color_class' => 'text-primary'];
        } elseif ($score >= 85) {
            return ['status' => 'Sukses', 'score' => $score, 'description' => 'Sangat Baik (Excellent)', 'color_class' => 'text-success'];
        } elseif ($score >= 80) {
            return ['status' => 'Sukses', 'score' => $score, 'description' => 'Baik (Very Good)', 'color_class' => 'text-info'];
        } else {
            return ['status' => 'Sukses', 'score' => $score, 'description' => 'Di Bawah Kualitas Spesialti', 'color_class' => 'text-warning'];
        }
    }

    private function getPhPrediction($plantation, $variety, $processingMethod)
    {
        $score = 5.2;

        if ($plantation->altitude > 1600) $score -= 0.3;
        elseif ($plantation->altitude > 1300) $score -= 0.15;
        elseif ($plantation->altitude < 1000) $score += 0.1;

        if ($variety->species === 'Robusta') $score += 0.25;
        elseif (in_array($variety->species, ['Liberika', 'Excelsa'])) $score += 0.2;

        if ($processingMethod === 'Semi-Washed / Wet-Hulled') $score += 0.25;
        elseif ($processingMethod === 'Natural / Dry') $score += 0.15;
        elseif ($processingMethod === 'Pulped natural / Honey') $score += 0.1;

        if ($plantation->soil_ph && $plantation->soil_ph < 5.5) $score -= 0.1; 
        elseif ($plantation->soil_ph && $plantation->soil_ph > 6.5) $score += 0.1;

        if ($plantation->organic_matter === 'Tinggi' || $plantation->organic_matter === 'Sangat Tinggi') $score -= 0.05;
        if ($plantation->drainage === 'Lambat (Padat)') $score += 0.1;
        if (str_contains($plantation->soil_texture ?? '', 'Liat')) $score += 0.05;

        if ($plantation->avg_temperature && $plantation->avg_temperature < 20) $score -= 0.05;
        if ($plantation->avg_temperature && $plantation->avg_temperature > 25) $score += 0.05;
        
        if ($plantation->yearly_precipitation && $plantation->yearly_precipitation > 2500) $score += 0.1;

        if ($plantation->slope_gradient && $plantation->slope_gradient > 25) $score -= 0.05; 
        if ($plantation->slope_aspect && in_array($plantation->slope_aspect, ['Timur', 'Tenggara'])) $score -= 0.05;

        $description = '';
        $colorClass = '';
        if ($score < 4.9) {
            $description = 'Keasaman Sangat Tinggi (Bright)'; $colorClass = 'text-success';
        } elseif ($score < 5.2) {
            $description = 'Keasaman Seimbang (Balanced)'; $colorClass = 'text-info';
        } elseif ($score < 5.5) {
            $description = 'Keasaman Lembut (Mild)'; $colorClass = 'text-primary';
        } else {
            $description = 'Keasaman Rendah (Low Acidity)'; $colorClass = 'text-warning';
        }

        $minPh = number_format($score - 0.1, 2, '.', '');
        $maxPh = number_format($score + 0.1, 2, '.', '');

        return ['range' => $minPh . " - " . $maxPh, 'description' => $description, 'color_class' => $colorClass];
    }
}