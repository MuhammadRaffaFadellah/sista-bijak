<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Umkm;
use App\Models\Rw;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UmkmExport;



class UmkmController extends Controller
{

    public function download()
    {
        $umkms = Umkm::all();
        
        return Excel::download(new UmkmExport, 'umkm_data.xlsx');
    }

    public function umkm_table(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $rws = Rw::all();
        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua UMKM
            $umkms = Umkm::query(); // Inisialisasi query
        } else {
            // Jika bukan admin, ambil UMKM sesuai RW pengguna
            $umkms = Umkm::where('rw', $user->rw_id);
        }

        // Pencarian berdasarkan nama pemilik atau NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $umkms->where(function($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $umkms->where('rw', $request->input('filter_rw'));
        }

        $umkms = $umkms->paginate(10);
        return view("umkm.umkm-table", compact('umkms', 'rws'));
    }
//     public function create()
// {
//     return view('create_umkm');
// }

public function edit($id)
{
    $umkm = Umkm::findOrFail($id);
    return view('create.create_umkm', compact('umkm'));
}

public function store(Request $request)
{
    $data = $request->all();
    foreach ($data['nama_rw'] as $index => $value) {
        Umkm::create([
            'nama_rw' => $data['nama_rw'][$index],
            'rw' => $data['rw'][$index],
            'jumlah_umkm' => $data['jumlah_umkm'][$index],
            'kategori_umkm' => $data['kategori_umkm'][$index],
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
        'kategori_umkm' => 'required|string|max:255',
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
