<?php

namespace App\Http\Controllers;

use App\Models\Meninggals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeninggalController extends Controller
{
    public function resident_died()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua data meninggal
            $dataMeninggal = Meninggals::paginate(10); // 10 entri per halaman
        } else {
            // Jika bukan admin, ambil data meninggal sesuai RW pengguna
            $dataMeninggal = Meninggals::where('rw', $user->rw_id)->paginate(10);
        }

        return view('resident.resident-died', compact('dataMeninggal'));
    }

    public function index()
    {
        $dataMeninggal = Meninggals::paginate(10);
        return view('resident.resident-died', compact('dataMeninggal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kepala_keluarga.*' => 'required|string',
            'nomer_kk.*' => 'required|numeric',
            'alamat.*' => 'required|string',
            'rw.*' => 'required|numeric',
            'rt.*' => 'required|numeric',
            'nama_almarhum.*' => 'required|string',
            'hubungan_dengan_kk.*' => 'required|string',
            'tempat_lahir.*' => 'required|string',
            'tanggal_lahir.*' => 'required|date',
            'tempat_meninggal.*' => 'required|string',
            'tanggal_meninggal.*' => 'required|date',
            'jenis_kelamin.*' => 'required|string',
        ]);

        // Iterasi setiap item data untuk dimasukkan satu per satu
        foreach ($request->nama_kepala_keluarga as $index => $value) {
            Meninggals::create([
                'nama_kepala_keluarga' => $request->nama_kepala_keluarga[$index],
                'nik' => $request->nik[$index],
                'alamat' => $request->alamat[$index],
                'rw' => $request->rw[$index],
                'rt' => $request->rt[$index],
                'nama_almarhum' => $request->nama_almarhum[$index],
                'hubungan_dengan_kk' => $request->hubungan_dengan_kk[$index],
                'tempat_lahir' => $request->tempat_lahir[$index],
                'tanggal_lahir' => $request->tanggal_lahir[$index],
                'tempat_meninggal' => $request->tempat_meninggal[$index],
                'tanggal_meninggal' => $request->tanggal_meninggal[$index],
                'jenis_kelamin' => $request->jenis_kelamin[$index],
            ]);
        }

        return redirect()->route('resident-died')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $meninggal = Meninggals::findOrFail($id);
        return view('create_died', compact('meninggal'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kepala_keluarga' => 'required|string',
            'nik' => 'required|numeric',
            'alamat' => 'required|string',
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'nama_almarhum' => 'required|string',
            'hubungan_dengan_kk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'jenis_kelamin' => 'required|string',
        ]);
    
        $meninggal = Meninggals::findOrFail($id);
        
        $meninggal->update($request->except('_token'));
    
        return redirect()->route('resident-died')->with('success', 'Data berhasil diupdate');
    }
    

    public function destroy($id)
    {
        $meninggal = Meninggals::findOrFail($id);
        $meninggal->delete();
        return redirect()->route('resident-died')->with('success', 'Data berhasil dihapus');
    }
}
