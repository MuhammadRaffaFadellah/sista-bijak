<?php

namespace App\Http\Controllers;

use App\Models\Lahir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LahirController extends Controller
{
    // Display the list of Lahir entries
    public function resident_born(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua data lahir
            $query = Lahir::query();
        } else {
            // Jika bukan admin, ambil data lahir sesuai RW pengguna
            $query = Lahir::where('rw', $user->rw_id);
        }

        // Pencarian berdasarkan nama kepala keluarga atau NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_kepala_keluarga', 'like', "%{$search}%")
                ->orWhere('nama_anak_lahir', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $dataLahir = $query->paginate(10); // 10 entri per halaman
        $statusKependudukanOptions = ['LAHIR'];

        return view('resident.resident-born', compact('dataLahir', 'statusKependudukanOptions'));
    }

    // Show the form for creating a new Lahir entry
    public function create()
    {
        $statusKependudukanOptions = ['LAHIR'];
        return view('create.create_born', compact('statusKependudukanOptions'));
    }

    // Store a newly created Lahir entry in storage
    public function store(Request $request)
    {
        $request->validate([
            'nik.*' => 'required|unique:lahir,nik',
            'nama_kepala_keluarga.*' => 'required',
            'alamat.*' => 'required',
            'rw.*' => 'required',
            'rt.*' => 'required',
            'nama_ayah_kandung.*' => 'required',
            'nama_ibu_kandung.*' => 'required',
            'nama_anak_lahir.*' => 'required',
            'tempat_lahir.*' => 'required',
            'tanggal_lahir.*' => 'required|date',
            'jenis_kelamin.*' => 'required',
            'status_kependudukan.*' => 'required',
        ]);

        $data = $request->all();
        foreach ($data['nik'] as $index => $nik) {
            Lahir::create([
                'nik' => $nik,
                'nama_kepala_keluarga' => $data['nama_kepala_keluarga'][$index],
                'alamat' => $data['alamat'][$index],
                'rw' => $data['rw'][$index],
                'rt' => $data['rt'][$index],
                'nama_ayah_kandung' => $data['nama_ayah_kandung'][$index],
                'nama_ibu_kandung' => $data['nama_ibu_kandung'][$index],
                'nama_anak_lahir' => $data['nama_anak_lahir'][$index],
                'tempat_lahir' => $data['tempat_lahir'][$index],
                'tanggal_lahir' => $data['tanggal_lahir'][$index],
                'jenis_kelamin' => $data['jenis_kelamin'][$index],
                'status_kependudukan' => $data['status_kependudukan'][$index],
            ]);
        }

        return redirect()->route('resident-born')->with('success', 'Data berhasil ditambahkan.');
    }

    // Show the form for editing the specified Lahir entry
    public function edit($id)
    {
        $lahir = Lahir::findOrFail($id);
        $statusKependudukanOptions = ['LAHIR'];
        return view('create_born', compact('lahir', 'statusKependudukanOptions'));
    }

    // Update the specified Lahir entry in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:lahir,nik,' . $id,
            'nama_kepala_keluarga' => 'required',
            'alamat' => 'required',
            'rw' => 'required',
            'rt' => 'required',
            'nama_ayah_kandung' => 'required',
            'nama_ibu_kandung' => 'required',
            'nama_anak_lahir' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'status_kependudukan' => 'required',
        ]);

        $lahir = Lahir::findOrFail($id);
        $lahir->update($request->all()); // Update the lahir data
        return redirect()->route('resident-born')->with('success', 'Data berhasil diperbarui.');
    }

    // Remove the specified Lahir entry from storage
    public function destroy($id)
    {
        $lahir = Lahir::findOrFail($id);
        $lahir->delete(); // Delete the lahir data
        return redirect()->route('resident-born')->with('success', 'Data berhasil dihapus.');
    }
}