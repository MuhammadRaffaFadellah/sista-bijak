<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', function () {
    return view('index');
});

// Route untuk import
Route::get('/import', function () {
    return view('import');
});
Route::post('/import', [PendudukController::class, 'importData'])->name('import.data');

// Route untuk dashboard
Route::get('/dashboard', [PendudukController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk resident table
Route::get('/resident-table', [PendudukController::class, 'resident_table'])->middleware(['auth', 'verified'])->name('resident.table');

// Route untuk penduduk
Route::middleware('auth')->group(function () {
    Route::resource('penduduk', PendudukController::class);
    
    // Route untuk profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

require __DIR__.'/auth.php';
