<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\LahirController;
use App\Http\Controllers\MeninggalController;
use App\Http\Controllers\MigrasiController;
use App\Http\Controllers\UmkmController;
use App\Models\Penduduk;
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
Route::get("/resident-table", [PendudukController::class, 'resident_table'])->middleware('auth', 'verified')->name('table');
// Manajemen CRUD Route (VIEW)
Route::get("/user-management", [ManagementController::class, 'users_management'])->middleware('auth', 'verified')->name('user-management');
// Manajemen CRUD Route (ADD)
Route::get("/form-add-user", [ManagementController::class, "form_add_users"])->middleware('auth', 'verified')->name("add-users");
Route::get("/process-add-users", [ManagementController::class, "process_add_users"])->middleware('auth', 'verified')->name("add-users");
Route::post("/process-add-users", [ManagementController::class, "process_add_users"])->middleware('auth', 'verified')->name("add-users");
// Manajemen CRUD Route (EDIT)
Route::get("/user-management/{id}/editUser", [ManagementController::class, 'form_edit_users'])->middleware('auth', 'verified')->name("form-edit");
Route::get("/process-edit-users", [ManagementController::class, 'process_edit_users'])->middleware('auth', 'verified')->name("edit-users");
Route::post("/process-edit-users", [ManagementController::class, 'process_edit_users'])->middleware('auth', 'verified')->name("edit-users");

// Manajemen CRUD Route (DELETE)
Route::get("/user-management/{id}/deleteUser", [ManagementController::class, "process_delete_users"])->middleware('auth', 'verified')->name("delete-users");

// UMKM CRUD Route
Route::get("/umkm-table",[UmkmController::class, "umkm_table"])->middleware("auth", "verified")->name("umkm");
Route::get("/umkm-table",[UmkmController::class, "umkm_table"])->middleware("auth", "verified")->name("umkm");
Route::post('/umkm-store', [UmkmController::class, 'store'])->name('umkm.store');
Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('umkm.update');
// Route untuk hapus UMKM
Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');

// Resident Route
Route::middleware('auth')->group(function () {
    Route::resource('penduduk', PendudukController::class);
    
    // Route untuk profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

// Route untuk resident table
Route::get('/resident-table', [PendudukController::class, 'resident_table'])->middleware(['auth', 'verified'])->name('resident.table');
// Route untuk resident born table
Route::get('/resident-born', [LahirController::class, 'resident_born'])->middleware(['auth', 'verified'])->name('resident-born');
// Route for creating Lahir
Route::resource('lahir', LahirController::class);

// Route untuk resident died table
Route::get('/resident-died', [MeninggalController::class, 'resident_died'])->middleware(['auth', 'verified'])->name('resident-died');
Route::resource('meninggal', MeninggalController::class)->middleware(['auth', 'verified']);

Route::get('/resident-migration', [MigrasiController::class, 'resident_migration'])->middleware(['auth', 'verified'])->name('resident-migration');
Route::resource('migrasi', MigrasiController::class)->middleware(['auth', 'verified']);
Route::get('/resident-migration/{id}', [MigrasiController::class, 'show'])->middleware(['auth', 'verified'])->name('migrasi.show');
Route::get('/resident-migration/{id}/edit', [MigrasiController::class, 'edit'])->middleware(['auth', 'verified'])->name('migrasi.edit');

require __DIR__.'/auth.php';