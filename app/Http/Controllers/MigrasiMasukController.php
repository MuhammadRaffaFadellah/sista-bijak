<?php

namespace App\Http\Controllers;

use App\Models\Penduduk; // Menggunakan model Penduduk
use Illuminate\Http\Request;
use App\Models\rw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exports\MigrasiMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class MigrasiMasukController extends Controller
{
    // Menampilkan daftar penduduk dengan status "Masuk"
    public function resident_migration_in(Request $request)
    {
        $user = Auth::user();
        $rws = rw::all();

        // Ambil data penduduk dengan status "Masuk"
        $dataPenduduk = Penduduk::where('status_kependudukan', 'Masuk');

        // Search by name or NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $dataPenduduk->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter by RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $dataPenduduk->where('rw', $request->input('filter_rw'));
        }

        // Paginate the results
        $penduduk = $dataPenduduk->paginate(10);

        return view('resident.resident-migration-in', compact('penduduk', 'rws'));
    }

    // Menampilkan form untuk menambah data penduduk
    public function create()
    {
        $rws = rw::all();
        return view('create.create_migration_in', compact('rws'));
    }

    // Menyimpan data penduduk baru
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

        return redirect()->route('resident-migration-in')->with('success', 'Data penduduk berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit data penduduk
    public function edit($nik)
    {
        try {
            $rws = rw::all();
            Log::info('Edit method called with NIK: ' . $nik);
            $penduduk = Penduduk::where('nik', $nik)->firstOrFail();
            Log::info('Penduduk data found', ['data' => $penduduk->toArray()]);

            // Kirim variabel ke view
            return view('create.create_migration_in', compact('penduduk', 'rws'));
        } catch (\Exception $e) {
            Log::error('Error in edit method', ['error' => $e->getMessage()]);
            return redirect()->route('resident-migration-in')->with('error', 'Data tidak ditemukan');
        }
    }

    // Memperbarui data penduduk
    public function update(Request $request, $nik)
    {
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

        // Retrieve the penduduk data by nik
        $penduduk = Penduduk::where('nik', $nik)->firstOrFail();

        // Update penduduk data with new input
        $penduduk->update($request->all());

        return redirect()->route('resident-migration-in')->with('success', 'Data berhasil diupdate');
    }

    // Menghapus data penduduk
    public function destroy($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('resident-migration-in')->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function download()
    {
        return Excel::download(new MigrasiMasukExport, 'penduduk_data.xlsx');
    }
}