<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route for FARMERS
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


});

// Route for ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route for Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // --- Data Management Routes ---
    Route::resource('varieties', \App\Http\Controllers\Admin\VarietyController::class);
    Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class);
    Route::resource('farmers', \App\Http\Controllers\Admin\FarmerController::class);
    Route::resource('plantations', \App\Http\Controllers\Admin\PlantationController::class);

    // --- Parameter Data Routes ---
    Route::get('/parameters/climate', function() { 
        return 'Halaman Manajemen Parameter Iklim'; 
    })->name('parameters.climate');

    Route::get('/parameters/topography', function() { 
        return 'Halaman Manajemen Parameter Topografi'; 
    })->name('parameters.topography');

    Route::get('/parameters/soil', function() { 
        return 'Halaman Manajemen Parameter Tanah'; 
    })->name('parameters.soil');

    // --- Analysis Routes ---
    Route::get('/analysis/prediction', function() { 
        return 'Halaman Prediksi Kualitas'; 
    })->name('analysis.prediction');

    Route::get('/analysis/history', function() { 
        return 'Halaman Riwayat Prediksi'; 
    })->name('analysis.history');

});

require __DIR__.'/auth.php';
