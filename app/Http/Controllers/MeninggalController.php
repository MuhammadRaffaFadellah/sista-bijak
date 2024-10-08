<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Meninggals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Rw;

class MeninggalController extends Controller
{
    public function resident_died(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $rws = Rw::all();
        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua data meninggal
            $dataMeninggal = Meninggals::query(); // Inisialisasi query
        } else {
            // Jika bukan admin, ambil data meninggal sesuai RW pengguna
            $dataMeninggal = Meninggals::where('rw', $user->rw_id);
        }
        // Pencarian berdasarkan nama atau NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $dataMeninggal->where(function ($q) use ($search) {
                $q->where('nama_almarhum', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }
        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $dataMeninggal->where('rw', $request->input('filter_rw'));
        }
        $dataMeninggal = $dataMeninggal->paginate(10);
        return view('resident.resident-died', compact('dataMeninggal', 'rws'));
    }

    public function index()
    {
        $dataMeninggal = Meninggals::paginate(10);
        return view('resident.resident-died', compact('dataMeninggal'));
    }

    public function store(Request $request)
    {
        // Validasi input tanpa "nama kepala keluarga"
        $request->validate([
            'nik' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|numeric|exists:rw,id',
            'rt' => 'required|numeric',
            'nama_almarhum' => 'required|string',
            'hubungan_dengan_kk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string',
            'tanggal_meninggal' => 'required|date',
        ]);

        // Menyimpan data ke tabel meninggal
        Meninggals::create([
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'nama_almarhum' => $request->nama_almarhum,
            'hubungan_dengan_kk' => $request->hubungan_dengan_kk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_meninggal' => $request->tempat_meninggal,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'jenis_kelamin' => $request->jenis_kelamin, // Ambil dari form
            'status_kependudukan' => 'MENINGGAL',
        ]);
        // Menghapus data penduduk secara permanen setelah form meninggal disubmit
        $penduduk = Penduduk::find($request->penduduk_id);
        if ($penduduk) {
            $penduduk->forceDelete(); // Hapus data secara permanen
        }
        // Redirect ke halaman yang diinginkan
        return redirect()->route('resident-died')->with('success', 'Data meninggal berhasil ditambahkan dan penduduk dihapus.');
    }

    public function edit($id)
    {
        try {
            $rws = Rw::all();
            Log::info('Edit method called with ID: ' . $id);
            $meninggal = Meninggals::findOrFail($id);
            Log::info('Meninggal data found', ['data' => $meninggal->toArray()]);

            // Cari data penduduk berdasarkan NIK dari data meninggal
            $penduduk = Penduduk::where('nik', $meninggal->nik)->first();
            Log::info('Penduduk data found', ['data' => $penduduk ? $penduduk->toArray() : null]);
            // Tambahkan log untuk nilai jenis_kelamin
            Log::info('Jenis Kelamin Penduduk:', ['jenis_kelamin' => $penduduk->jenis_kelamin ?? null]);
            // Kirim data meninggal, penduduk, dan semua data RW ke view
            return view('create.create_died', compact('meninggal', 'penduduk', 'rws'));
        } catch (\Exception $e) {
            Log::error('Error in edit method', ['error' => $e->getMessage()]);
            return redirect()->route('resident-died')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nik' => 'required|numeric',
            'nama_almarhum' => 'required|string',
            'hubungan_dengan_kk' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'status_kependudukan' => 'required|string',
        ]);
        // Mengambil data dari tabel meninggal berdasarkan id
        $meninggal = Meninggals::findOrFail($id);
        // Update data meninggal dengan input baru
        $meninggal->update($request->all());
        // Redirect ke halaman 'resident-died' dengan pesan sukses
        return redirect()->route('resident-died')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $meninggal = Meninggals::findOrFail($id);
        $meninggal->delete();
        return redirect()->route('resident-died')->with('success', 'Data berhasil dihapus');
    }
}
