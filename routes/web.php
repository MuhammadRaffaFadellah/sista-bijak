<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\LahirController;
use App\Http\Controllers\MeninggalController;
use App\Http\Controllers\MigrasiController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\MigrasiMasukController;
use App\Http\Controllers\MigrasiKeluarController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MetadataController;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', function () {
    return view('index');
});

Route::get("/import", function (){
    return view('import');
});
Route::post('/import', [PendudukController::class, 'importData'])->name('import.data');

Route::get("/metadata", [MetadataController::class, 'index'])->name('metadata-article');

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
Route::get("/umkm-table", [UmkmController::class, "umkm_table"])->middleware("auth", "verified")->name("umkm");
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
    // Route untuk menampilkan form1
    Route::get('/form1', [ProfileController::class, 'showForm1'])->name('form1');
});
Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');
Route::get('/penduduk/{nik}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
Route::put('/penduduk/{nik}', [PendudukController::class, 'update'])->name('penduduk.update');

// Route untuk resident table
Route::get('/resident-table', [PendudukController::class, 'resident_table'])->middleware(['auth', 'verified'])->name('resident-table');


// Route untuk tabel lahir (resident born table)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/resident-born', [LahirController::class, 'resident_born'])->name('resident-born');
    // Route untuk membuat dan menyimpan data penduduk
    Route::get('lahir/create/{id}', [LahirController::class, 'create_resident'])->name('create_resident');
    Route::post('lahir/store', [LahirController::class, 'store_resident'])->name('store_resident');
    // Route untuk halaman create_chair
    Route::get('create_chair/create/{id}', [LahirController::class, 'create_resident'])->name('create_chair');
    Route::get('/create_chair', [PendudukController::class, 'create'])->name('create.create_chair');
    Route::post('/penduduk/store', [LahirController::class, 'store_resident'])->name('penduduk.store');
});

// Route resource untuk Lahir
Route::resource('lahir', LahirController::class);


// Route Resident-died
Route::get('/resident-died', [MeninggalController::class, 'resident_died'])->middleware(['auth', 'verified'])->name('resident-died');
Route::resource('meninggal', MeninggalController::class)->middleware(['auth', 'verified']);
Route::get('/penduduk/{id}/create_died', [PendudukController::class, 'createDied'])->name('create_died');


Route::resource('migrasi', MigrasiController::class)->middleware(['auth', 'verified']);
Route::get('/resident-migration', [MigrasiController::class, 'resident_migration'])->middleware(['auth', 'verified'])->name('resident-migration');

Route::get('/resident-migration/{id}/edit', [MigrasiController::class, 'edit'])->middleware(['auth', 'verified'])->name('migrasi.edit');
Route::get('/dashboard', [PendudukController::class, 'dashboard'])->name('dashboard');
Route::get('/', [PendudukController::class, 'index'])->name('index');


// Rute untuk menampilkan daftar migrasi masuk
Route::get('/resident-migration-in', [MigrasiMasukController::class, 'resident_migration_in'])->name('resident-migration-in');
// Rute untuk menampilkan form tambah data migrasi masuk
Route::resource('migrasimasuk', MigrasiMasukController::class);
Route::get('/resident-migration-in/create', [MigrasiMasukController::class, 'create'])->name('resident.migration-in-create');
// Rute untuk menyimpan data migrasi masuk baru
Route::post('/resident-migration-in', [MigrasiMasukController::class, 'store'])->name('resident.migration-in-store');
// Rute untuk menampilkan form edit data migrasi masuk
Route::get('/resident-migration-in/{nik}/edit', [MigrasiMasukController::class, 'edit'])->name('resident.migration-in-edit');
// Rute untuk memperbarui data migrasi masuk
Route::put('/resident-migration-in/{nik}', [MigrasiMasukController::class, 'update'])->name('resident.migration-in-update');
// Rute untuk menghapus data migrasi masuk
Route::delete('/resident-migration-in/{id}', [MigrasiMasukController::class, 'destroy'])->name('resident.migration-in-destroy');

Route::get('migrasimasuk/{id}/edit', [MigrasiMasukController::class, 'edit'])->name('migrasimasuk.edit');
Route::put('migrasimasuk/{id}', [MigrasiMasukController::class, 'update'])->name('migrasimasuk.update');

// Rute untuk menampilkan daftar migrasi keluar
Route::get('/resident-migration-out', [MigrasiKeluarController::class, 'resident_migration_out'])->name('resident-migration-out');

// Rute untuk menyimpan data migrasi keluar baru
Route::post('/resident-migration-out', [MigrasiKeluarController::class, 'store'])->name('resident.migration-out-store');
Route::get('/search-penduduk', [PendudukController::class, 'searchPenduduk'])->name('search.penduduk');
Route::get('/penduduk/search', 'PendudukController@searchPenduduk')->name('penduduk.search');

// Rute untuk menyimpan data migrasi keluar
Route::post('/migrasi-keluar', [MigrasiKeluarController::class, 'store'])->name('migrasi-keluar.store');
Route::resource('migrasikeluar', MigrasiKeluarController::class);
Route::get('migrasikeluar/{id}/edit', [MigrasiKeluarController::class, 'edit'])->name('migrasikeluar.edit');
Route::put('migrasikeluar/{id}', [MigrasiKeluarController::class, 'update'])->name('migrasikeluar.update');
Route::delete('/migrasikeluar/{id}', [MigrasiKeluarController::class, 'destroy'])->name('migrasikeluar.destroy');

//excel
Route::get('umkm/download', [UmkmController::class, 'download'])->name('umkm.download');
Route::get('/migrasi-masuk/download', [MigrasiMasukController::class, 'download'])->name('migrasi-masuk.download');
Route::get('/migrasi-keluar/download', [MigrasiKeluarController::class, 'download'])->name('migrasi-keluar.download');
Route::get('/table-penduduk/download', [PendudukController::class, 'download'])->name('table-penduduk.download');
Route::get('/resident-table/download', [PendudukController::class, 'download'])->name('resident-table.download');
Route::get('/resident-migration/{id}/edit', [MigrasiController::class, 'edit'])->middleware(['auth', 'verified'])->name('migrasi.edit');
Route::get('/table-lahir/download', [LahirController::class, 'download'])->name('table-lahir.download');
Route::get('/table-meninggal/download', [MeninggalController::class, 'download'])->name('table-meninggal.download');

//Tampilan halaman awal
Route::get('/dashboard', [PendudukController::class, 'dashboard'])->name('dashboard');
Route::get('/', [PendudukController::class, 'index'])->name('index');

// Images Route
Route::resource('images', ImageController::class);
Route::get("/images-table", [ImageController::class, "index"])->name("images.index");
Route::delete("/images/{id}", [ImageController::class, "destroy"])->name("images.destroy");
Route::get("/images/add-images", [ImageController::class, "show"])->name("images.show");

Route::get('/create_migration_out', [MigrasiKeluarController::class, 'create'])->name('create_migration_out');
Route::get('/create_migration_in', [MigrasiMasukController::class, 'create'])->name('create_migration_in');
Route::get('/create_died', [MeninggalController::class, 'create'])->name('create_died');
require __DIR__ . '/auth.php';
