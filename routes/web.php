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
    // Default Dashboard page for farmers
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //
});

// Route for ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin')->group(function () {
    // Default Dashboard page for admin
    Route::get('/dashboard', function () {
        return '<h1>Selamat Datang, Admin!</h1>';
    })->name('dashboard');

    //
});

require __DIR__.'/auth.php';
