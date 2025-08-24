<?php

use App\Http\Controllers\Admin\VarietyController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\PlantationController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\PredictionController;
use App\Http\Controllers\Admin\PredictionHistoryController;
use Illuminate\Support\Facades\Route;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Public/Guest Routes ---
Route::get('/', function () {
    return view('welcome');
});


// --- Authenticated User (Farmer) Routes ---
Route::middleware(['auth', 'verified'])->group(function () {
    // This is the main dashboard for logged-in farmers
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // We will add other farmer-specific routes here later (e.g., my notes, my profile)
});


// --- ADMIN ROUTES GROUP ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route for Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // -- Data Management Routes --
    Route::resource('varieties', VarietyController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('farmers', FarmerController::class);
    Route::get('/farmers/{user}/plantations', [FarmerController::class, 'getPlantationsForDropdown'])->name('farmers.plantations');
    Route::resource('plantations', PlantationController::class);

    // -- Parameter Data Routes --
    Route::get('/parameters/climate', [ParameterController::class, 'climate'])->name('parameters.climate');
    Route::get('/parameters/topography', [ParameterController::class, 'topography'])->name('parameters.topography');
    Route::get('/parameters/soil', [ParameterController::class, 'soil'])->name('parameters.soil');
    Route::get('/parameters/fetch/{type}', [ParameterController::class, 'fetchData'])->name('parameters.fetch');
    Route::post('/parameters/save-api/{plantation}', [ParameterController::class, 'saveApiData'])->name('parameters.saveApi');
    Route::post('/parameters/soil/{plantation}', [ParameterController::class, 'updateParameters'])->name('parameters.soil.update');

    // -- Analysis Routes --
    Route::get('/prediction', [PredictionController::class, 'index'])->name('analysis.prediction');
    Route::post('/prediction', [PredictionController::class, 'predict'])->name('analysis.predict');
    Route::get('/prediction/history', [PredictionHistoryController::class, 'index'])->name('analysis.history');
    Route::post('/prediction/history', [PredictionHistoryController::class, 'store'])->name('analysis.history.store');

});


// --- Auth Routes ---
require __DIR__.'/auth.php';