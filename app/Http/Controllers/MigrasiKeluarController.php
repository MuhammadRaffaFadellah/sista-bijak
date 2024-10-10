<?php

namespace App\Http\Controllers;

use App\Models\MigrasiKeluar;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Rw;


class MigrasiKeluarController extends Controller
{
    //
    public function resident_migration_out(Request $request)
    {
        $query = MigrasiKeluar::query();
        $user = Auth::user();
        $rws = rw::all();
        if ($user && $user->role_id === 1) {
            $dataMigrasiKeluar = MigrasiKeluar::query();
        } elseif ($user && isset($user->rw_id)) {
            $dataMigrasiKeluar = MigrasiKeluar::where('rw', $user->rw_id);
        } else {
            // Jika user tidak ditemukan atau tidak memiliki rw_id, lakukan penanganan yang sesuai
            abort(403, 'User tidak memiliki RW atau akses tidak diizinkan.');
        }

        if ($request->has('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        if ($request->has('filter_rw')) {
            $query->where('rw', $request->filter_rw);
        }
        $migrasiKeluar = $query->paginate(10);
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
        $rws = Rw::all();
        $migrasiKeluar = MigrasiKeluar::findOrFail($id);
        return view('create_migration_out', compact('migrasiKeluar', 'rws'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input berdasarkan field tabel
        $validatedData = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:migrasi_masuk,nik,' . $id,
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

        // Find the record and update it
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
}
