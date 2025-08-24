<?php

use App\Http\Controllers\Api\IndonesiaRegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/provinces', [IndonesiaRegionController::class, 'provinces'])->name('api.provinces');
Route::get('/cities/{provinceId}', [IndonesiaRegionController::class, 'cities'])->name('api.cities');
Route::get('/districts/{cityId}', [IndonesiaRegionController::class, 'districts'])->name('api.districts');
Route::get('/villages/{districtId}', [IndonesiaRegionController::class, 'villages'])->name('api.villages');