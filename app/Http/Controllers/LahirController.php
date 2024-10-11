<?php

namespace App\Http\Controllers;

use App\Models\Lahir;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\rw;
use App\Exports\LahirExport;
use Maatwebsite\Excel\Facades\Excel;

class LahirController extends Controller
{
    public function download()
    {
        return Excel::download(new LahirExport, 'table_lahir_data.xlsx');
    }
    // Display the list of Lahir entries
    public function resident_born(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $rws = rw::all();
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
            $query->where(function ($q) use ($search) {
                $q->where('nama_anak_lahir', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }
        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $query->where('rw', $request->input('filter_rw'));
        }
        $dataLahir = $query->paginate(10); // 10 entri per halaman
        $statusKependudukanOptions = ['LAHIR'];
        return view('resident.resident-born', compact('dataLahir', 'statusKependudukanOptions', 'rws'));
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
        $rws = rw::all();
        $lahir = Lahir::findOrFail($id);
        $statusKependudukanOptions = ['LAHIR'];
        return view('create.create_born', compact('lahir', 'statusKependudukanOptions', 'rws'));
    }

    // Update the specified Lahir entry in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:lahir,nik,' . $id,
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

    public function create_resident($id)
    {
        // Ambil data dari tabel lahir berdasarkan ID
        $lahir = Lahir::find($id);
        $penduduk = Penduduk::where('nik', $lahir->nik)->first(); // atau sesuai dengan kriteria yang benar
        $rws = rw::all();

        // Periksa apakah data ditemukan
        if (is_null($lahir)) {
            return redirect()->back()->with('error', 'Data lahir tidak ditemukan.');
        }

        // Kirim data dari tabel lahir dan penduduk ke view
        return view('create.create_chair', compact('lahir', 'penduduk', 'rws'));
    }


    public function store_resident(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nik' => 'required|string|max:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_hubkel' => 'required|string',
            'pendidikan_terakhir' => 'required|string|in:TAMAT SD/SEDERAJAT,BELUM TAMAT SD/SEDERAJAT,TIDAK TAMAT SD/SEDERAJAT,TIDAK/BELUM SEKOLAH,DIPLOMA I/II,AKADEMI/DIPLOMA III/S. MUDA,DIPLOMA IV/STRATA I,STRATA II,STRATA III,SLTA/SEDERAJAT,SLTP/SEDERAJAT',
            'jenis_pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'alamat' => 'required|string|max:255',
            'rw' => 'required|integer',
            'rt' => 'required|integer',
            'kelurahan' => 'required|string|max:255',
            'status_kependudukan' => 'required|string',
        ]);
        // Simpan data ke database (misalnya ke tabel penduduk)
        Penduduk::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_hubkel' => $request->status_hubkel,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'kelurahan' => $request->kelurahan,
            'status_kependudukan' => $request->status_kependudukan,
        ]);
        // Set session untuk menandakan bahwa data telah disimpan
        session(['data_saved' => true]);
        // Redirect ke halaman resident tabel dengan pesan sukses
        return redirect()->route('resident-table')->with('success', 'Data berhasil disimpan.');
    }
}
