<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/import', function () {
    return view('import');
});

Route::post('/import', [PendudukController::class, 'importData'])->name('import.data');

Route::get('/dashboard', [PendudukController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get("/resident-table", [PendudukController::class, 'resident_table'])->middleware('auth', 'verified')->name('table');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
