<?php

namespace App\Http\Controllers;

use App\Models\MigrasiMasuk;
use Illuminate\Http\Request;
use App\Models\Rw;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MigrasiMasukController extends Controller
{
    // Menampilkan daftar migrasi masuk
    public function resident_migration_in(Request $request)
    {
        $query = MigrasiMasuk::query();
        $user = Auth::user();
        $rws = Rw::all();

        if ($user->role->id === 1) {
            $dataMigrasiMasuk = MigrasiMasuk::query();
        } else {
            $dataMigrasiMasuk = MigrasiMasuk::where('rw', $user->rw_id);
        }

        // Search
        if ($request->has('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        // Filter RW
        if ($request->has('filter_rw')) {
            $query->where('rw', $request->filter_rw);
        }
        $migrasiMasuk = $query->paginate(10);
        return view('resident.resident-migration-in', compact('migrasiMasuk', 'rws'));
    }

    // Menampilkan form untuk menambah data migrasi masuk
    public function create()
    {
        $rws = Rw::all();
        return view('resident.migration-in-create', compact('rws'));
    }

    // Menyimpan data migrasi masuk baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik.*' => 'required|string',
            'nama_lengkap.*' => 'required|string',
            'jenis_kelamin.*' => 'required|string',
            'tempat_lahir.*' => 'required|string',
            'tanggal_lahir.*' => 'required|date',
            'status_hubkel.*' => 'required|string',
            'pendidikan_terakhir.*' => 'required|string',
            'jenis_pekerjaan.*' => 'nullable|string',
            'agama.*' => 'required|string',
            'status_perkawinan.*' => 'required|string',
            'alamat.*' => 'required|string',
            'rw.*' => 'required|integer',
            'rt.*' => 'required|integer',
            'kelurahan.*' => 'required|string',
            'status_kependudukan.*' => 'required|string',
        ]);

        foreach ($validatedData['nik'] as $index => $nik) {
            $migrasiMasuk = MigrasiMasuk::create([
                'nik' => $nik,
                'nama_lengkap' => $validatedData['nama_lengkap'][$index],
                'jenis_kelamin' => $validatedData['jenis_kelamin'][$index],
                'tempat_lahir' => $validatedData['tempat_lahir'][$index],
                'tanggal_lahir' => $validatedData['tanggal_lahir'][$index],
                'status_hubkel' => $validatedData['status_hubkel'][$index],
                'pendidikan_terakhir' => $validatedData['pendidikan_terakhir'][$index],
                'jenis_pekerjaan' => $validatedData['jenis_pekerjaan'][$index],
                'agama' => $validatedData['agama'][$index],
                'status_perkawinan' => $validatedData['status_perkawinan'][$index],
                'alamat' => $validatedData['alamat'][$index],
                'rw' => $validatedData['rw'][$index],
                'rt' => $validatedData['rt'][$index],
                'kelurahan' => $validatedData['kelurahan'][$index],
                'status_kependudukan' => $validatedData['status_kependudukan'][$index],
            ]);

            // Simpan ke Penduduk
            Penduduk::create([
                'nik' => $nik,
                'nama_lengkap' => $validatedData['nama_lengkap'][$index],
                'jenis_kelamin' => $validatedData['jenis_kelamin'][$index],
                'tempat_lahir' => $validatedData['tempat_lahir'][$index],
                'tanggal_lahir' => $validatedData['tanggal_lahir'][$index],
                'status_hubkel' => $validatedData['status_hubkel'][$index],
                'pendidikan_terakhir' => $validatedData['pendidikan_terakhir'][$index],
                'jenis_pekerjaan' => $validatedData['jenis_pekerjaan'][$index],
                'agama' => $validatedData['agama'][$index],
                'status_perkawinan' => $validatedData['status_perkawinan'][$index],
                'alamat' => $validatedData['alamat'][$index],
                'rw' => $validatedData['rw'][$index],
                'rt' => $validatedData['rt'][$index],
                'kelurahan' => $validatedData['kelurahan'][$index],
                'status_kependudukan' => $validatedData['status_kependudukan'][$index],
            ]);
        }

        return redirect()->route('resident-migration-in')->with('success', 'Data migrasi masuk berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit data migrasi masuk
    public function edit($id)
{
    try {
        $rws = Rw::all();
        Log::info('Edit method called with ID: ' . $id);
        $migrasiMasuk = MigrasiMasuk::findOrFail($id);
        Log::info('Migrasi Masuk data found', ['data' => $migrasiMasuk->toArray()]);

        // Find the corresponding penduduk data based on NIK
        $penduduk = Penduduk::where('nik', $migrasiMasuk->nik)->first();
        Log::info('Penduduk data found', ['data' => $penduduk ? $penduduk->toArray() : null]);

        // Send migrasiMasuk, penduduk, and all RW data to the view
        return view('create_migration_in', compact('migrasiMasuk', 'penduduk', 'rws'));
    } catch (\Exception $e) {
        Log::error('Error in edit method', ['error' => $e->getMessage()]);
        return redirect()->route('create_migration_in')
            ->with('error', 'Data tidak ditemukan');
    }
}

public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'nik' => 'required|numeric',
        'nama_lengkap' => 'required|string',
        'jenis_kelamin' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'status_hubkel' => 'required|string',
        'pendidikan_terakhir' => 'required|string',
        'jenis_pekerjaan' => 'nullable|string',
        'agama' => 'required|string',
        'status_perkawinan' => 'required|string',
        'alamat' => 'required|string',
        'rw' => 'required|numeric',
        'rt' => 'required|numeric',
        'kelurahan' => 'required|string',
        'status_kependudukan' => 'required|string',
    ]);

    // Retrieve the migrasi_masuk data by id
    $migrasiMasuk = MigrasiMasuk::findOrFail($id);

    // Update migrasi_masuk data with new input
    $migrasiMasuk->update($request->all());

    // Update the corresponding penduduk data
    $penduduk = Penduduk::where('nik', $migrasiMasuk->nik)->first();
    if ($penduduk) {
        $penduduk->update($request->only([
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_hubkel',
            'pendidikan_terakhir',
            'jenis_pekerjaan',
            'agama',
            'status_perkawinan',
            'alamat',
            'rw',
            'rt',
            'kelurahan',
            'status_kependudukan',
        ]));
    }

    // Redirect to the 'resident-migration-in' page with a success message
    return redirect()->route('resident-migration-in')->with('success', 'Data berhasil diupdate');
}


    // Menghapus data migrasi masuk
    public function destroy($id)
    {
        $migrasiMasuk = MigrasiMasuk::findOrFail($id);
        $penduduk = Penduduk::where('nik', $migrasiMasuk->nik)->first();
        if ($penduduk) {
            $penduduk->delete();
        }
        $migrasiMasuk->delete();

        return redirect()->route('resident-migration-in')->with('success', 'Data migrasi masuk berhasil dihapus.');
    }
}
