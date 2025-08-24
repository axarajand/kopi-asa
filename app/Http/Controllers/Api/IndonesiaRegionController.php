<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndonesiaRegionController extends Controller
{
    // Base URL for the external API
    protected $baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';

    public function provinces()
    {
        $response = Http::get($this->baseUrl . 'provinces.json');
        return $response->json();
    }

    public function cities($provinceId)
    {
        $response = Http::get($this->baseUrl . "regencies/{$provinceId}.json");
        return $response->json();
    }

    public function districts($cityId)
    {
        $response = Http::get($this->baseUrl . "districts/{$cityId}.json");
        return $response->json();
    }

    public function villages($districtId)
    {
        $response = Http::get($this->baseUrl . "villages/{$districtId}.json");
        return $response->json();
    }
}