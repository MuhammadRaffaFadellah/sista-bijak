<?php

namespace App\Http\Controllers;

use App\Models\Migrasi;
use App\Models\AnggotaMigrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MigrasiController extends Controller
{
    public function resident_migration()
    {
        $user = Auth::user();

        if ($user->role->id === 1) {
            $dataMigrasi = Migrasi::paginate(10);
        } else {
            $dataMigrasi = Migrasi::where('rw', $user->rw_id)->paginate(10);
        }

        return view('resident-migration', compact('dataMigrasi'));
    }

    public function index()
    {
        $dataMigrasi = Migrasi::paginate(10);
        return view('resident-migration', compact('dataMigrasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_migrasi' => 'required|in:masuk,keluar',
            'nama_kepala_keluarga' => 'required|string',
            'nik' => 'required|numeric|unique:migrasi,nik',
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'anggota.*.nama' => 'required|string',
            'anggota.*.tempat_lahir' => 'required|string',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'anggota.*.hubungan_dengan_kk' => 'required|string',
            'anggota.*.pendidikan' => 'required|string',
            'anggota.*.pekerjaan' => 'required|string',
        ]);

        // Buat migrasi baru
        $migrasi = Migrasi::create([
            'jenis_migrasi' => $request->jenis_migrasi,
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'nik' => $request->nik,
            'rw' => $request->rw,
            'rt' => $request->rt,
        ]);

        // Tambah anggota migrasi
        foreach ($request->anggota as $anggota) {
            $migrasi->anggotaMigrasi()->create($anggota);
        }

        return redirect()->route('resident-migration')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $migrasi = Migrasi::with('anggotaMigrasi')->findOrFail($id);
        return view('migrasi.show', compact('migrasi'));
    }

    public function edit($id)
    {
        $migrasi = Migrasi::with('anggotaMigrasi')->findOrFail($id);
        return view('migrasi.edit', compact('migrasi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'jenis_migrasi' => 'required|in:masuk,keluar',
            'nama_kepala_keluarga' => 'required|string',
            'nik' => 'required|numeric|unique:migrasi,nik,' . $id,
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'anggota.*.nama' => 'required|string',
            'anggota.*.tempat_lahir' => 'required|string',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'anggota.*.hubungan_dengan_kk' => 'required|string',
            'anggota.*.pendidikan' => 'required|string',
            'anggota.*.pekerjaan' => 'required|string',
        ]);

        // Update migrasi
        $migrasi = Migrasi::findOrFail($id);
        $migrasi->update($request->only('jenis_migrasi', 'nama_kepala_keluarga', 'nik', 'rw', 'rt'));

        // Hapus anggota yang ada dan tambahkan yang baru
        $migrasi->anggotaMigrasi()->delete();
        foreach ($request->anggota as $anggota) {
            $migrasi->anggotaMigrasi()->create($anggota);
        }

        return redirect()->route('resident-migration')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $migrasi = Migrasi::findOrFail($id);
        $migrasi->delete();
        return redirect()->route('resident-migration')->with('success', 'Data berhasil dihapus');
    }
}
