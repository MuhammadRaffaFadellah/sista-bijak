<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Imports\PendudukImport;
use App\Models\Lahir;
use App\Models\Meninggals;
use App\Models\Migrasi;
use App\Models\AnggotaMigrasi;
use App\Models\Umkm;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Rw;

class PendudukController extends Controller
{
    public function importData()
    {
        try {
            // Import data menggunakan class PendudukImport
            Excel::import(new PendudukImport, request()->file('your_file'));

            // Redirect dengan pesan sukses
            return redirect('/import')->with('success', 'Berhasil Import Data');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('/import')->with('error', 'Gagal Import Data: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        // Ambil semua data yang diperlukan tanpa memerlukan login pengguna
        $penduduks = Penduduk::paginate(10);
        $totalPenduduk = Penduduk::whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalLakiLaki = Penduduk::where('jenis_kelamin', 'LAKI-LAKI')
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'PEREMPUAN')
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalLahir = Lahir::where('status_kependudukan', 'LAHIR')->count();
        $totalLahirLakiLaki = Lahir::where('status_kependudukan', 'LAHIR')
            ->where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalLahirPerempuan = Lahir::where('status_kependudukan', 'LAHIR')
            ->where('jenis_kelamin', 'PEREMPUAN')->count();
        $totalMeninggal = Meninggals::where('status_kependudukan', 'MENINGGAL')->count();
        $totalMeninggalLakiLaki = Meninggals::where('status_kependudukan', 'MENINGGAL')
            ->where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalMeninggalPerempuan = Meninggals::where('status_kependudukan', 'MENINGGAL')
            ->where('jenis_kelamin', 'PEREMPUAN')->count();

        // Menghitung jumlah anggota keluarga yang bermigrasi
        $totalMigrasiMasuk = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->count();

        $totalMigrasiMasukLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->where('jenis_kelamin', 'LAKI-LAKI')->count();

        $totalMigrasiKeluar = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->count();

        $totalMigrasiKeluarLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->where('jenis_kelamin', 'LAKI-LAKI')->count();

        $totalMigrasiMasukPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->where('jenis_kelamin', 'PEREMPUAN')->count();

        $totalMigrasiKeluarPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->where('jenis_kelamin', 'PEREMPUAN')->count();

        $proporsiLK = $totalPenduduk > 0 ? number_format(($totalLakiLaki / $totalPenduduk) * 100, 2) : 0;
        $proporsiPR = $totalPenduduk > 0 ? number_format(($totalPerempuan / $totalPenduduk) * 100, 2) : 0;

        // Update total penduduk dan jenis kelamin berdasarkan migrasi
        $totalPenduduk += $totalLahir - $totalMeninggal + $totalMigrasiMasuk - $totalMigrasiKeluar;
        $totalLakiLaki += $totalLahirLakiLaki - $totalMeninggalLakiLaki + $totalMigrasiMasukLakiLaki - $totalMigrasiKeluarLakiLaki;
        $totalPerempuan += $totalLahirPerempuan - $totalMeninggalPerempuan + $totalMigrasiMasukPerempuan - $totalMigrasiKeluarPerempuan;

        $totalUmkm = Umkm::where('jumlah_umkm', 'UMKM')->count();
        $totalUmkmIndustri = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'industri pengolahan')->count();
        $totalUmkmPerdagangan = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'perdagangan')->count();
        $totalUmkmPenyediaAkomodasi = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'penyedia akomodasi')->count();
        $totalUmkmKonstruksi = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'konstruksi')->count();
        $totalUmkmJasaLainnya = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'jasa lainnya')->count();

        // Menghitung total jumlah UMKM dari kolom jumlah_umkm
        $totalUmkm = Umkm::sum('jumlah_umkm');

        // Menghitung total jumlah UMKM berdasarkan jenis dan kolom jumlah_umkm
        $totalUmkmIndustri = Umkm::where('jenis_umkm', 'industri pengolahan')->sum('jumlah_umkm');
        $totalUmkmPerdagangan = Umkm::where('jenis_umkm', 'perdagangan besar/eceran')->sum('jumlah_umkm');
        $totalUmkmPenyediaAkomodasi = Umkm::where('jenis_umkm', 'penyedia akomodasi & makan minum')->sum('jumlah_umkm');
        $totalUmkmKonstruksi = Umkm::where('jenis_umkm', 'konstruksi')->sum('jumlah_umkm');
        $totalUmkmJasaLainnya = Umkm::where('jenis_umkm', 'jasa lainnya')->sum('jumlah_umkm');


        return view('dashboard', compact(
            'penduduks',
            'totalPenduduk',
            'totalLakiLaki',
            'totalPerempuan',
            'proporsiLK',
            'proporsiPR',
            'totalLahir',
            'totalLahirLakiLaki',
            'totalLahirPerempuan',
            'totalMeninggal',
            'totalMeninggalLakiLaki',
            'totalMeninggalPerempuan',
            'totalMigrasiMasuk',
            'totalMigrasiKeluar',
            'totalMigrasiMasukPerempuan',
            'totalMigrasiKeluarPerempuan',
            'totalMigrasiMasukLakiLaki',
            'totalMigrasiKeluarLakiLaki',
            'totalUmkm',
            'totalUmkmIndustri',
            'totalUmkmPerdagangan',
            'totalUmkmPenyediaAkomodasi',
            'totalUmkmKonstruksi',
            'totalUmkmJasaLainnya'
        ));
    }

    public function index()
    {
        // Ambil semua data yang diperlukan tanpa memerlukan login pengguna
        $penduduks = Penduduk::paginate(10);
        $totalPenduduk = Penduduk::whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalLakiLaki = Penduduk::where('jenis_kelamin', 'LAKI-LAKI')
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'PEREMPUAN')
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        $totalLahir = Lahir::where('status_kependudukan', 'LAHIR')->count();
        $totalLahirLakiLaki = Lahir::where('status_kependudukan', 'LAHIR')
            ->where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalLahirPerempuan = Lahir::where('status_kependudukan', 'LAHIR')
            ->where('jenis_kelamin', 'PEREMPUAN')->count();
        $totalMeninggal = Meninggals::where('status_kependudukan', 'MENINGGAL')->count();
        $totalMeninggalLakiLaki = Meninggals::where('status_kependudukan', 'MENINGGAL')
            ->where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalMeninggalPerempuan = Meninggals::where('status_kependudukan', 'MENINGGAL')
            ->where('jenis_kelamin', 'PEREMPUAN')->count();

        // Menghitung jumlah anggota keluarga yang bermigrasi
        $totalMigrasiMasuk = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->count();

        $totalMigrasiMasukLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->where('jenis_kelamin', 'LAKI-LAKI')->count();

        $totalMigrasiKeluar = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->count();

        $totalMigrasiKeluarLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->where('jenis_kelamin', 'LAKI-LAKI')->count();

        $totalMigrasiMasukPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'masuk');
        })->where('jenis_kelamin', 'PEREMPUAN')->count();

        $totalMigrasiKeluarPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) {
            $query->where('jenis_migrasi', 'keluar');
        })->where('jenis_kelamin', 'PEREMPUAN')->count();

        $proporsiLK = $totalPenduduk > 0 ? number_format(($totalLakiLaki / $totalPenduduk) * 100, 2) : 0;
        $proporsiPR = $totalPenduduk > 0 ? number_format(($totalPerempuan / $totalPenduduk) * 100, 2) : 0;

        // Update total penduduk dan jenis kelamin berdasarkan migrasi
        $totalPenduduk += $totalLahir - $totalMeninggal + $totalMigrasiMasuk - $totalMigrasiKeluar;
        $totalLakiLaki += $totalLahirLakiLaki - $totalMeninggalLakiLaki + $totalMigrasiMasukLakiLaki - $totalMigrasiKeluarLakiLaki;
        $totalPerempuan += $totalLahirPerempuan - $totalMeninggalPerempuan + $totalMigrasiMasukPerempuan - $totalMigrasiKeluarPerempuan;

        $totalUmkm = Umkm::where('jumlah_umkm', 'UMKM')->count();
        $totalUmkmIndustri = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'industri pengolahan')->count();
        $totalUmkmPerdagangan = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'perdagangan')->count();
        $totalUmkmPenyediaAkomodasi = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'penyedia akomodasi')->count();
        $totalUmkmKonstruksi = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'konstruksi')->count();
        $totalUmkmJasaLainnya = Umkm::where('jumlah_umkm', 'UMKM')
            ->where('jenis_umkm', 'jasa lainnya')->count();

        // Menghitung total jumlah UMKM dari kolom jumlah_umkm
        $totalUmkm = Umkm::sum('jumlah_umkm');

        // Menghitung total jumlah UMKM berdasarkan jenis dan kolom jumlah_umkm
        $totalUmkmIndustri = Umkm::where('jenis_umkm', 'industri pengolahan')->sum('jumlah_umkm');
        $totalUmkmPerdagangan = Umkm::where('jenis_umkm', 'perdagangan besar/eceran')->sum('jumlah_umkm');
        $totalUmkmPenyediaAkomodasi = Umkm::where('jenis_umkm', 'penyedia akomodasi & makan minum')->sum('jumlah_umkm');
        $totalUmkmKonstruksi = Umkm::where('jenis_umkm', 'konstruksi')->sum('jumlah_umkm');
        $totalUmkmJasaLainnya = Umkm::where('jenis_umkm', 'jasa lainnya')->sum('jumlah_umkm');


        return view('index', compact(
            'penduduks',
            'totalPenduduk',
            'totalLakiLaki',
            'totalPerempuan',
            'proporsiLK',
            'proporsiPR',
            'totalLahir',
            'totalLahirLakiLaki',
            'totalLahirPerempuan',
            'totalMeninggal',
            'totalMeninggalLakiLaki',
            'totalMeninggalPerempuan',
            'totalMigrasiMasuk',
            'totalMigrasiKeluar',
            'totalMigrasiMasukPerempuan',
            'totalMigrasiKeluarPerempuan',
            'totalMigrasiMasukLakiLaki',
            'totalMigrasiKeluarLakiLaki',
            'totalUmkm',
            'totalUmkmIndustri',
            'totalUmkmPerdagangan',
            'totalUmkmPenyediaAkomodasi',
            'totalUmkmKonstruksi',
            'totalUmkmJasaLainnya'
        ));
    }

    public function resident_table(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Cek apakah user adalah admin berdasarkan ID role
        if ($user->role->id === 1) { // pastikan membandingkan dengan id, bukan role_id
            // Jika admin, ambil semua penduduk
            $query = Penduduk::query();
        } else {
            // Jika bukan admin, ambil penduduk sesuai RW pengguna
            $query = Penduduk::where('rw', $user->rw_id);
        }

        // Pencarian berdasarkan nama atau NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $query->where('rw', $request->input('filter_rw'));
        }

        $penduduks = $query->paginate(10);

        return view('resident.resident-table', compact('penduduks'));
    }

    public function create()
    {
        $hubkelOptions = ['Kepala Keluarga', 'Isri', 'Anak', 'Famili Lain', 'Sepupu', 'Mertua', 'Orang Tua', 'Cucu', 'Pembantu', 'Lainnya'];
        $pendidikanOptions = ['AKADEMI/DIPLOMA III/S.MUDA', 'BELUM TAMAT SD/SEDERAJAT', 'DIPLOMA I/II', 'DIPLOMA IV/STRATA I', 'SLTA/SEDERAJAT', 'STRATA II', 'STRATA III', 'TAMAT SD/SEDERAJAT', 'TIDAK TAMAT SD/SEDERAJAT', 'TIDAK/BELUM SEKOLAH'];
        $agamaOptions = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'];
        $statusOptions = ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'];
        $statusKependudukanOptions = ['MENETAP', 'KELUAR', 'MASUK'];
        return view('create.create_chair', compact('hubkelOptions', 'pendidikanOptions', 'agamaOptions', 'statusOptions', 'statusKependudukanOptions'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nik' => 'required|unique:penduduk|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_hubkel' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'jenis_pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'kelurahan' => 'required|string',
            'status_kependudukan' => 'required|string',
        ]);

        // Simpan data penduduk
        Penduduk::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('resident.resident.table')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $hubkelOptions = ['Kepala Keluarga', 'Isri', 'Anak', 'Famili Lain', 'Sepupu', 'Mertua', 'Orang Tua', 'Cucu', 'Pembantu', 'Lainnya'];
        $pendidikanOptions = ['AKADEMI/DIPLOMA III/S.MUDA', 'BELUM TAMAT SD/SEDERAJAT', 'DIPLOMA I/II', 'DIPLOMA IV/STRATA I', 'SLTA/SEDERAJAT', 'STRATA II', 'STRATA III', 'TAMAT SD/SEDERAJAT', 'TIDAK TAMAT SD/SEDERAJAT', 'TIDAK/BELUM SEKOLAH'];
        $agamaOptions = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'];
        $statusOptions = ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'];
        $statusKependudukanOptions = ['MENETAP', 'KELUAR', 'MASUK'];
        return view('create_chair', compact('penduduk', 'hubkelOptions', 'pendidikanOptions', 'agamaOptions', 'statusOptions', 'statusKependudukanOptions'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nik' => 'required|max:16|unique:penduduk,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_hubkel' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'jenis_pekerjaan' => 'nullable|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'kelurahan' => 'required|string',
            'status_kependudukan' => 'required|string',
        ]);

        // Update data penduduk
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('resident.table')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            // Temukan data penduduk berdasarkan id
            $penduduk = Penduduk::findOrFail($id);

            // Hapus data penduduk
            $penduduk->delete();

            // Redirect ke halaman tabel dengan pesan sukses
            return redirect()->route('resident.table')->with('success', 'Data penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani jika ada kesalahan
            return redirect()->route('resident.resident.table')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
