<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Umkm;
use App\Models\rw;


class UmkmController extends Controller
{
    public function umkm_table(){
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua penduduk
            $umkms = Umkm::paginate(10); // 10 entri per halaman
        } else {
            // Jika bukan admin, ambil penduduk sesuai RW pengguna
            $umkms = Umkm::where('rw', $user->rw_id)->paginate(10);
        }
        return view("umkm.umkm-table", compact('umkms'));
    }
//     public function create()
// {
//     return view('create_umkm');
// }

public function edit($id)
{
    $umkm = Umkm::findOrFail($id);
    return view('create_umkm', compact('umkm'));
}

public function store(Request $request)
{
    $data = $request->all();
    foreach ($data['nama_rw'] as $index => $value) {
        Umkm::create([
            'nama_rw' => $data['nama_rw'][$index],
            'rw' => $data['rw'][$index],
            'jumlah_umkm' => $data['jumlah_umkm'][$index],
            'jenis_umkm' => $data['jenis_umkm'][$index],
            'nama_pemilik' => $data['nama_pemilik'][$index],
            'nik' => $data['nik'][$index],
            'alamat' => $data['alamat'][$index],
        ]);
    }
    return redirect()->route('umkm')->with('success', 'Data berhasil ditambahkan');
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'nama_rw' => 'required|string|max:255',
        'rw' => 'required|string|max:255',
        'jumlah_umkm' => 'required|integer',
        'jenis_umkm' => 'required|string|max:255',
        'nama_pemilik' => 'required|string|max:255',
        'nik' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
    ]);

    $umkm = Umkm::findOrFail($id);
    $umkm->update($data);

    return redirect()->route('umkm')->with('success', 'Data berhasil diperbarui');
}
public function destroy($id)
{
    $umkm = Umkm::findOrFail($id);
    $umkm->delete();

    return redirect()->route('umkm')->with('success', 'Data berhasil dihapus');
}
}
