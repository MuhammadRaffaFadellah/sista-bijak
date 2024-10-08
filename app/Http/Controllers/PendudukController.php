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
use Illuminate\Support\Facades\Log;
use App\Models\Rw;

class PendudukController extends Controller
{
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
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('jenis_kelamin', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $query->where('rw', $request->input('filter_rw'));
        }
        $penduduks = $query->paginate(10);
        return view('resident.resident-table', compact('penduduks'));
    }


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
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $rw_id = $user->rw_id;

        if ($user->role->id === 1) {
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
        } else {
            $penduduks = Penduduk::where('rw', $rw_id)->paginate(10);
            $totalPenduduk = Penduduk::where('rw', $rw_id)->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalLakiLaki = Penduduk::where('rw', $rw_id)->where('jenis_kelamin', 'LAKI-LAKI')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalPerempuan = Penduduk::where('rw', $rw_id)->where('jenis_kelamin', 'PEREMPUAN')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalLahir = Lahir::where('rw', $rw_id)->where('status_kependudukan', 'LAHIR')->count();
            $totalLahirLakiLaki = Lahir::where('rw', $rw_id)->where('status_kependudukan', 'LAHIR')
                ->where('jenis_kelamin', 'LAKI-LAKI')->count();
            $totalLahirPerempuan = Lahir::where('rw', $rw_id)->where('status_kependudukan', 'LAHIR')
                ->where('jenis_kelamin', 'PEREMPUAN')->count();
            $totalMeninggal = Meninggals::where('rw', $rw_id)->where('status_kependudukan', 'MENINGGAL')->count();
            $totalMeninggalLakiLaki = Meninggals::where('rw', $rw_id)->where('status_kependudukan', 'MENINGGAL')
                ->where('jenis_kelamin', 'LAKI-LAKI')->count();
            $totalMeninggalPerempuan = Meninggals::where('rw', $rw_id)->where('status_kependudukan', 'MENINGGAL')
                ->where('jenis_kelamin', 'PEREMPUAN')->count();

            // Menghitung jumlah anggota keluarga yang bermigrasi
            $totalMigrasiMasuk = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'masuk')->where('rw', $rw_id);
            })->count();

            $totalMigrasiMasukLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'masuk')->where('rw', $rw_id);
            })->where('jenis_kelamin', 'LAKI-LAKI')->count();

            $totalMigrasiKeluar = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'keluar')->where('rw', $rw_id);
            })->count();

            $totalMigrasiKeluarLakiLaki = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'keluar')->where('rw', $rw_id);
            })->where('jenis_kelamin', 'LAKI-LAKI')->count();

            $totalMigrasiMasukPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'masuk')->where('rw', $rw_id);
            })->where('jenis_kelamin', 'PEREMPUAN')->count();

            $totalMigrasiKeluarPerempuan = AnggotaMigrasi::whereHas('migrasi', function ($query) use ($rw_id) {
                $query->where('jenis_migrasi', 'keluar')->where('rw', $rw_id);
            })->where('jenis_kelamin', 'PEREMPUAN')->count();

            $totalUmkm = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')->count();
            $totalUmkmIndustri = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')
                ->where('jenis_umkm', 'industri pengolahan')->count();
            $totalUmkmPerdagangan = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')
                ->where('jenis_umkm', 'perdagangan')->count();
            $totalUmkmPenyediaAkomodasi = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')
                ->where('jenis_umkm', 'penyedia akomodasi')->count();
            $totalUmkmKonstruksi = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')
                ->where('jenis_umkm', 'konstruksi')->count();
            $totalUmkmJasaLainnya = Umkm::where('rw', $rw_id)->where('jumlah_umkm', 'UMKM')
                ->where('jenis_umkm', 'jasa lainnya')->count();
        }

        $proporsiLK = $totalPenduduk > 0 ? number_format(($totalLakiLaki / $totalPenduduk) * 100, 2) : 0;
        $proporsiPR = $totalPenduduk > 0 ? number_format(($totalPerempuan / $totalPenduduk) * 100, 2) : 0;

        // Update total penduduk dan jenis kelamin berdasarkan migrasi
        $totalPenduduk += $totalLahir + $totalMigrasiMasuk - $totalMigrasiKeluar;
        $totalLakiLaki += $totalLahirLakiLaki + $totalMigrasiMasukLakiLaki - $totalMigrasiKeluarLakiLaki;
        $totalPerempuan += $totalLahirPerempuan + $totalMigrasiMasukPerempuan - $totalMigrasiKeluarPerempuan;

        // Menghitung total jumlah UMKM dari kolom jumlah_umkm
        $totalUmkm = Umkm::when($user->role->id !== 1, function ($query) use ($rw_id) {
            return $query->where('rw', $rw_id);
        })->sum('jumlah_umkm');

        // Menghitung total jumlah UMKM berdasarkan jenis dan kolom jumlah_umkm
        $totalUmkmIndustri = Umkm::where('jenis_umkm', 'industri pengolahan')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })->sum('jumlah_umkm');

        $totalUmkmPerdagangan = Umkm::where('jenis_umkm', 'perdagangan besar/eceran')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })->sum('jumlah_umkm');

        $totalUmkmPenyediaAkomodasi = Umkm::where('jenis_umkm', 'penyedia akomodasi & makan minum')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })->sum('jumlah_umkm');

        $totalUmkmKonstruksi = Umkm::where('jenis_umkm', 'konstruksi')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })->sum('jumlah_umkm');

        $totalUmkmJasaLainnya = Umkm::where('jenis_umkm', 'jasa lainnya')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })->sum('jumlah_umkm');

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
        $totalPenduduk += $totalLahir + $totalMigrasiMasuk - $totalMigrasiKeluar;
        $totalLakiLaki += $totalLahirLakiLaki + $totalMigrasiMasukLakiLaki - $totalMigrasiKeluarLakiLaki;
        $totalPerempuan += $totalLahirPerempuan + $totalMigrasiMasukPerempuan - $totalMigrasiKeluarPerempuan;

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

    public function getGenderData()
    {
        // Tabel-tabel yang ingin diambil datanya
        $tables = ['penduduk', 'lahir', 'meninggal', 'umkm']; // Ganti dengan nama tabelmu
        $result = [
            'lakiLaki' => array_fill(1, 12, 0), // Menyimpan data jumlah laki-laki per bulan
            'perempuan' => array_fill(1, 12, 0), // Menyimpan data jumlah perempuan per bulan
        ];
        foreach ($tables as $table) {
            // Mengambil data jenis kelamin dan bulan dari created_at
            $data = DB::table($table)
                ->select(DB::raw('jenis_kelamin, MONTH(created_at) as month'))
                ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun berjalan
                ->get();
            foreach ($data as $item) {
                // Memperbarui jumlah berdasarkan jenis kelamin dan bulan
                if ($item->jenis_kelamin === 'LAKI-LAKI') {
                    $result['lakiLaki'][$item->month]++;
                } else if ($item->jenis_kelamin === 'PEREMPUAN') {
                    $result['perempuan'][$item->month]++;
                }
            }
        }
        // Mengirim hasilnya dalam format JSON
        return response()->json($result);
    }

    public function destroy($id)
    {
        try {
            // Temukan data penduduk berdasarkan id
            $penduduk = Penduduk::findOrFail($id);
            // Hapus data penduduk
            $penduduk->delete();
            // Redirect ke halaman tabel dengan pesan sukses
            return redirect()->route('resident-table')->with('success', 'Data penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani jika ada kesalahan
            return redirect()->route('resident-table')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function createDied($id)
    {
        // Mencari data penduduk berdasarkan ID (tanpa menghapusnya)
        $penduduk = Penduduk::find($id);
        // Tambahkan ini untuk debug
        $rws = Rw::all(); // Ambil semua data RW
        // Validasi apakah penduduk ditemukan
        if (!$penduduk) {
            return redirect()->route('resident-table')->with('error', 'Penduduk tidak ditemukan.');
        }
        // Tampilkan form tambah data meninggal
        return view('create.create_died', compact('penduduk', 'rws'));
    }

    // Method store untuk menyimpan data penduduk
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:LAKI-LAKI,PEREMPUAN',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_hubkel' => 'required|string|in:kepala keluarga,istri,anak,cucu,famili lain,lainnya,menantu,mertua,orang tua,pembantu',
            'pendidikan_terakhir' => 'required|string|in:belum tamat sd/sederajat,akademi/diploma iii/s.muda,diploma i/ii,diploma iv/strata i,slta/sederajat,sltp/sederajat,strata ii,strata iii,tamat sd/sederajat,tidak tamat sd/sederajat,tidak/belum sekolah',
            'jenis_pekerjaan' => 'required|string|in:Dokter,Apoteker,Dosen,Guru,Anggota DPRD Kabupaten/Kota,Karyawan BUMN,Karyawan BUMD,Bidan,Juru Masak,Buruh Harian Lepas,Buruh Nelayan/Perikanan,Buruh Tani/Perkebunan,Belum/Tidak Bekerja,Pegawai Negeri Sipil (PNS),Kepolisian RI,Karyawan Swasta,Konsultan,Notaris,Pedagang,Mekanik,Nelayan/Perikanan,Penata Rias,Pelajar/Mahasiswa,Pelaut,Karyawan Honorer,Mengelola Rumah Tangga,Pembantu Rumah Tangga,Pengacara,Perawat,Penyiar Radio,Wartawan,Ustadz/Mubaligh,Seniman,Perdagangan,Sopir,Tukang Cukur,Tukang Jahit,Tukang Kayu,Tukang Listrik,Tentara Nasional Indonesia,Wiraswasta,Pensiunan',
            'agama' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|string|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'alamat' => 'required|string|max:255',
            'rw' => 'required|exists:rw,id', // Validasi RW harus ada di tabel `rw`
            'rt' => 'required|numeric',
            'kelurahan' => 'required|string|max:255', // Validasi kelurahan, bisa juga disesuaikan dengan referensi jika ada
            'status_kependudukan' => 'required|string|in:LAHIR,MENINGGAL,PINDAH',
        ]);
        // Simpan data jika validasi berhasil
        Penduduk::create($validatedData);
        // Redirect atau tampilkan pesan sukses
        return redirect()->route('resident-table')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penduduk = Penduduk::find($id);
        // Pastikan data ditemukan
        if (!$penduduk) {
            return redirect()->route('resident-table')->with('error', 'Data penduduk tidak ditemukan.');
        }
        return view('penduduk.show', compact('penduduk')); // Ganti dengan view yang sesuai
    }
}
