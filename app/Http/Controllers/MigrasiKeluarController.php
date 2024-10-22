<?php

namespace App\Http\Controllers;

use App\Models\MigrasiKeluar;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\rw;
use App\Exports\MigrasiKeluarExport;
use Maatwebsite\Excel\Facades\Excel;


class MigrasiKeluarController extends Controller
{
    //
    public function resident_migration_out(Request $request)
    {
        $user = Auth::user();
        $rws = rw::all();

        // Initialize the query
        $dataMigrasiKeluar = MigrasiKeluar::query();

        // Filter based on user role
        if ($user && $user->role_id !== 1) {
            if (isset($user->rw_id)) {
                $dataMigrasiKeluar->where('rw', $user->rw_id);
            } else {
                abort(403, 'User tidak memiliki RW atau akses tidak diizinkan.');
            }
        }

        // Search by name or NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $dataMigrasiKeluar->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter by RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $dataMigrasiKeluar->where('rw', $request->input('filter_rw'));
        }

        // Paginate the results
        $migrasiKeluar = $dataMigrasiKeluar->paginate(10);

        return view('resident.resident-migration-out', compact('migrasiKeluar', 'rws'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string',
            'nama_lengkap' => 'required|string',
        ]);

        // Cari penduduk berdasarkan NIK atau nama
        $penduduk = Penduduk::where('nik', $request->nik)
            ->orWhere('nama_lengkap', $request->nama_lengkap)
            ->first();

        // Cek apakah penduduk ditemukan
        if (!$penduduk) {
            return redirect()->route('resident-migration-out')->with('error', 'Penduduk tidak ditemukan.');
        }

        // Buat catatan baru di migrasi_keluar
        MigrasiKeluar::create([
            'penduduk_id' => $penduduk->id,
            'nik' => $penduduk->nik,
            'nama_lengkap' => $penduduk->nama_lengkap,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'status_hubkel' => $penduduk->status_hubkel,
            'pendidikan_terakhir' => $penduduk->pendidikan_terakhir,
            'jenis_pekerjaan' => $penduduk->jenis_pekerjaan,
            'agama' => $penduduk->agama,
            'status_perkawinan' => $penduduk->status_perkawinan,
            'alamat' => $penduduk->alamat,
            'rw' => $penduduk->rw,
            'rt' => $penduduk->rt,
            'kelurahan' => $penduduk->kelurahan,
            'status_kependudukan' => 'Keluar',
        ]);

        // Hapus data dari tabel Penduduk
        $penduduk->delete();

        return redirect()->route('resident-migration-out')->with('success', 'Data migrasi keluar berhasil ditambahkan dan penduduk dihapus.');
    }

    public function checkDataExists(Request $request)
    {
        $nik = $request->query('nik');
        // Validasi input NIK
        if (empty($nik)) {
            return response()->json(['exists' => false]);
        }
        // Cari penduduk berdasarkan NIK
        $pendudukExists = Penduduk::where('nik', $nik)->exists();
        return response()->json(['exists' => $pendudukExists]);
    }



    public function edit($id)
    {
        $rws = rw::all();
        $migrasiKeluar = MigrasiKeluar::findOrFail($id);
        return view('create.create_migration_out', compact('migrasiKeluar', 'rws'));
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nik' => 'required|numeric|digits:16|unique:migrasi_keluar,nik,' . $id,
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'status_hubkel' => 'required|string|max:255',
        'pendidikan_terakhir' => 'required|string|max:255',
        'jenis_pekerjaan' => 'nullable|string|max:255',
        'agama' => 'required|string|in:Islam,Kristen,Hindu,Buddha,Konghucu',
        'status_perkawinan' => 'required|string|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
        'alamat' => 'required|string|max:255',
        'rw' => 'required|integer',
        'rt' => 'required|integer',
        'kelurahan' => 'required|string|max:255',
        'status_kependudukan' => 'required|string|max:255',
    ]);

    // Update data
    $migrasiKeluar = MigrasiKeluar::findOrFail($id);
    $migrasiKeluar->update($validatedData);

    return redirect()->route('resident-migration-out')->with('success', 'Data migrasi keluar berhasil diperbarui.');
}

    public function destroy($id)
    {
        $migrasi = MigrasiKeluar::findOrFail($id);
        $migrasi->delete();
        return redirect()->route('resident-migration-out')->with('success', 'Data berhasil dihapus');
    }

    public function download()
    {
        return Excel::download(new MigrasiKeluarExport, 'migrasi_keluar_data.xlsx');
    }

    public function create(Request $request)
    {
        $nik = $request->query('nik');
        $penduduk = Penduduk::where('nik', $nik)->first();
        $rws = RW::all(); // Ambil data RW dari model

        if (!$penduduk) {
            return redirect()->route('resident-migration-out')->with('error', 'Penduduk tidak ditemukan.');
        }

        return view('create.create_migration_out', compact('penduduk', 'rws'));
    }
}
