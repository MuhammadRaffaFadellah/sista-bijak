<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\LahirController;
use App\Http\Controllers\MeninggalController;
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
Route::get("/form-add-user", [ManagementController::class, "form_add_users"])->middleware('auth', 'verified')->name("form-add-users");
Route::get("/process-add-users", [ManagementController::class, "process_add_users"])->middleware('auth', 'verified')->name("process-add-users");
Route::post("/process-add-users", [ManagementController::class, "process_add_users"])->middleware('auth', 'verified')->name("process-add-users");
// Manajemen CRUD Route (EDIT)
Route::get("/user-management/{id}/editUser", [ManagementController::class, 'form_edit_users'])->middleware('auth', 'verified')->name("form_edit_user");
Route::get("/process-edit-users", [ManagementController::class, 'process_edit_users'])->middleware('auth', 'verified')->name("process_edit_user");
Route::post("/process-edit-users", [ManagementController::class, 'process_edit_users'])->middleware('auth', 'verified')->name("process_edit_user");

// Manajemen CRUD Route (DELETE)
Route::get("/user-management/{id}/deleteUser", [ManagementController::class, "process_delete_users"])->middleware('auth', 'verified')->name("process-delete-users");

// Route untuk penduduk
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

require __DIR__.'/auth.php';
