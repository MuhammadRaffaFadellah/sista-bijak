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
use App\Models\MigrasiKeluar;
use App\Models\MigrasiMasuk;
use App\Models\Rw;
use App\Exports\PendudukExport;

class PendudukController extends Controller
{
    public function download()
    {
        return Excel::download(new PendudukExport, 'table_penduduk_data.xlsx');
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

        // Logika untuk admin
        if ($user->role->id === 1) {
            $penduduks = Penduduk::paginate(10);
            $totalPenduduk = Penduduk::whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalLakiLaki = Penduduk::where('jenis_kelamin', 'LAKI-LAKI')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalPerempuan = Penduduk::where('jenis_kelamin', 'PEREMPUAN')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        } else {
            // Logika untuk non-admin (RW)
            $penduduks = Penduduk::where('rw', $rw_id)->paginate(10);
            $totalPenduduk = Penduduk::where('rw', $rw_id)
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalLakiLaki = Penduduk::where('rw', $rw_id)
                ->where('jenis_kelamin', 'LAKI-LAKI')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
            $totalPerempuan = Penduduk::where('rw', $rw_id)
                ->where('jenis_kelamin', 'PEREMPUAN')
                ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])->count();
        }

        // Ambil data untuk grafik, filter by RW jika bukan admin
        $pendudukDataQuery = Penduduk::select('rw', 'jenis_kelamin', DB::raw('count(*) as total'))
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR']);

        if ($user->role->id !== 1) {
            $pendudukDataQuery->where('rw', $rw_id);
        }

        $pendudukData = $pendudukDataQuery->groupBy('rw', 'jenis_kelamin')->get();

        $dataByRw = [];
        foreach ($pendudukData as $data) {
            $dataByRw[$data->rw][$data->jenis_kelamin] = $data->total;
        }

        // Lahir, Meninggal, Migrasi: Sesuaikan data untuk RW
        $totalLahirQuery = Lahir::where('status_kependudukan', 'LAHIR');
        $totalMeninggalQuery = Meninggals::where('status_kependudukan', 'MENINGGAL');
        $totalMigrasiMasukQuery = MigrasiMasuk::query();
        $totalMigrasiKeluarQuery = MigrasiKeluar::query();

        if ($user->role->id !== 1) {
            $totalLahirQuery->where('rw', $rw_id);
            $totalMeninggalQuery->where('rw', $rw_id);
            $totalMigrasiMasukQuery->where('rw', $rw_id);
            $totalMigrasiKeluarQuery->where('rw', $rw_id);
        }

        // Menghitung total data kelahiran, meninggal, dan migrasi
        $totalLahir = $totalLahirQuery->count();
        $totalLahirLakiLaki = Lahir::where('jenis_kelamin', 'LAKI-LAKI')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();
        $totalLahirPerempuan = Lahir::where('jenis_kelamin', 'PEREMPUAN')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();

        $totalMeninggal = $totalMeninggalQuery->count();
        $totalMeninggalLakiLaki = Meninggals::where('jenis_kelamin', 'LAKI-LAKI')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();
        $totalMeninggalPerempuan = Meninggals::where('jenis_kelamin', 'PEREMPUAN')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();

        $totalMigrasiMasuk = $totalMigrasiMasukQuery->count();
        $totalMigrasiKeluar = $totalMigrasiKeluarQuery->count();

        $totalMigrasiMasukLakiLaki = MigrasiMasuk::where('jenis_kelamin', 'LAKI-LAKI')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();
        $totalMigrasiMasukPerempuan = MigrasiMasuk::where('jenis_kelamin', 'PEREMPUAN')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();
        $totalMigrasiKeluarLakiLaki = MigrasiKeluar::where('jenis_kelamin', 'LAKI-LAKI')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();
        $totalMigrasiKeluarPerempuan = MigrasiKeluar::where('jenis_kelamin', 'PEREMPUAN')
            ->when($user->role->id !== 1, function ($query) use ($rw_id) {
                return $query->where('rw', $rw_id);
            })
            ->count();

        // Proporsi
        $proporsiLK = $totalPenduduk > 0 ? number_format(($totalLakiLaki / $totalPenduduk) * 100, 2) : 0;
        $proporsiPR = $totalPenduduk > 0 ? number_format(($totalPerempuan / $totalPenduduk) * 100, 2) : 0;

        // Data UMKM
        $umkmQuery = Umkm::query();

        if ($user->role->id !== 1) {
            $umkmQuery->where('rw', $rw_id);
        }

        $totalUmkm = $umkmQuery->sum('jumlah_umkm');

        // Pisahkan query untuk setiap jenis UMKM
        $totalUmkmIndustri = Umkm::where('jenis_umkm', 'industri pengolahan');
        $totalUmkmPerdagangan = Umkm::where('jenis_umkm', 'perdagangan besar/eceran');
        $totalUmkmPenyediaAkomodasi = Umkm::where('jenis_umkm', 'penyedia akomodasi & makan minum');
        $totalUmkmKonstruksi = Umkm::where('jenis_umkm', 'konstruksi');
        $totalUmkmJasaLainnya = Umkm::where('jenis_umkm', 'jasa lainnya');

        // Tambahkan filter RW untuk non-admin
        if ($user->role->id !== 1) {
            $totalUmkmIndustri->where('rw', $rw_id);
            $totalUmkmPerdagangan->where('rw', $rw_id);
            $totalUmkmPenyediaAkomodasi->where('rw', $rw_id);
            $totalUmkmKonstruksi->where('rw', $rw_id);
            $totalUmkmJasaLainnya->where('rw', $rw_id);
        }

        // Hitung total untuk setiap jenis UMKM
        $totalUmkmIndustri = $totalUmkmIndustri->sum('jumlah_umkm');
        $totalUmkmPerdagangan = $totalUmkmPerdagangan->sum('jumlah_umkm');
        $totalUmkmPenyediaAkomodasi = $totalUmkmPenyediaAkomodasi->sum('jumlah_umkm');
        $totalUmkmKonstruksi = $totalUmkmKonstruksi->sum('jumlah_umkm');
        $totalUmkmJasaLainnya = $totalUmkmJasaLainnya->sum('jumlah_umkm');

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
            'totalUmkmJasaLainnya',
            'dataByRw'
        ));
    }




    public function index()
    {
        // Ambil data untuk grafik
        $pendudukData = Penduduk::select('rw', 'jenis_kelamin', DB::raw('count(*) as total'))
            ->whereNotIn('status_kependudukan', ['MENINGGAL', 'KELUAR'])
            ->groupBy('rw', 'jenis_kelamin')
            ->get();

        $dataByRw = [];
        foreach ($pendudukData as $data) {
            $dataByRw[$data->rw][$data->jenis_kelamin] = $data->total;
        }

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
        $totalMigrasiMasuk = MigrasiMasuk::count();
        $totalMigrasiKeluar = MigrasiKeluar::count();

        $totalMigrasiMasukLakiLaki = MigrasiMasuk::where('jenis_kelamin', 'LAKI-LAKI')->count();
        $totalMigrasiKeluarLakiLaki = MigrasiKeluar::where('jenis_kelamin', 'LAKI-LAKI')->count();

        $totalMigrasiMasukPerempuan = MigrasiMasuk::where('jenis_kelamin', 'PEREMPUAN')->count();
        $totalMigrasiKeluarPerempuan = MigrasiKeluar::where('jenis_kelamin', 'PEREMPUAN')->count();

        $proporsiLK = $totalPenduduk > 0 ? number_format(($totalLakiLaki / $totalPenduduk) * 100, 2) : 0;
        $proporsiPR = $totalPenduduk > 0 ? number_format(($totalPerempuan / $totalPenduduk) * 100, 2) : 0;

        // Update total penduduk dan jenis kelamin berdasarkan migrasi
        $totalPenduduk;
        $totalLakiLaki;
        $totalPerempuan;

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
            'totalUmkmJasaLainnya',
            'dataByRw'
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
        try {
            // Ambil data penduduk berdasarkan ID
            $penduduk = Penduduk::findOrFail($id);

            // Cek apakah Anda perlu mengambil data lahir
            // Jika Anda tidak memerlukan data lahir, bisa dihapus
            // Jika diperlukan, ambil data lahir sesuai logika Anda
            $lahir = Lahir::all(); // Hanya jika Anda memerlukan data ini

            // Ambil semua RW
            $rws = rw::all();

            // Opsi lainnya tetap sama
            $hubkelOptions = ['Kepala Keluarga', 'Istri', 'Anak', 'Famili Lain', 'Sepupu', 'Mertua', 'Orang Tua', 'Cucu', 'Pembantu', 'Lainnya'];
            $pendidikanOptions = ['AKADEMI/DIPLOMA III/S.MUDA', 'BELUM TAMAT SD/SEDERAJAT', 'DIPLOMA I/II', 'DIPLOMA IV/STRATA I', 'SLTA/SEDERAJAT', 'STRATA II', 'STRATA III', 'TAMAT SD/SEDERAJAT', 'TIDAK TAMAT SD/SEDERAJAT', 'TIDAK/BELUM SEKOLAH'];
            $agamaOptions = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'];
            $statusOptions = ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'];
            $statusKependudukanOptions = ['Menetap', 'Keluar', 'Masuk'];

            return view('create.create_chair', compact('penduduk', 'rws', 'hubkelOptions', 'pendidikanOptions', 'agamaOptions', 'statusOptions', 'statusKependudukanOptions'));
        } catch (\Exception $e) {
            return redirect()->route('resident-migration-in')->with('error', 'Data tidak ditemukan');
        }
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang diupdate
        $validatedData = $request->validate([
            'nik' => 'required|numeric',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_hubkel' => 'required|string|max:50',
            'pendidikan_terakhir' => 'required|string|max:50',
            'jenis_pekerjaan' => 'nullable|string|max:50',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'rw' => 'required|exists:rw,id',
            'rt' => 'required|numeric',
            'kelurahan' => 'required|string|max:50',
            'status_kependudukan' => 'required|string',
        ]);
        // Cari data penduduk berdasarkan ID
        $penduduk = Penduduk::findOrFail($id);
        // Update data penduduk
        $penduduk->update($validatedData);
        // Jika status kependudukan berubah menjadi 'Keluar', pindahkan data ke tabel migrasi keluar
        if ($validatedData['status_kependudukan'] === 'Keluar') {
            // Pindahkan data ke tabel migrasi keluar
            $migrasiKeluar = new MigrasiKeluar();
            $migrasiKeluar->nik = $penduduk->nik;
            $migrasiKeluar->nama_lengkap = $penduduk->nama_lengkap;
            $migrasiKeluar->jenis_kelamin = $penduduk->jenis_kelamin;
            $migrasiKeluar->tempat_lahir = $penduduk->tempat_lahir;
            $migrasiKeluar->tanggal_lahir = $penduduk->tanggal_lahir;
            $migrasiKeluar->status_hubkel = $penduduk->status_hubkel;
            $migrasiKeluar->pendidikan_terakhir = $penduduk->pendidikan_terakhir;
            $migrasiKeluar->jenis_pekerjaan = $penduduk->jenis_pekerjaan;
            $migrasiKeluar->agama = $penduduk->agama;
            $migrasiKeluar->status_perkawinan = $penduduk->status_perkawinan;
            $migrasiKeluar->alamat = $penduduk->alamat;
            $migrasiKeluar->rw = $penduduk->rw;
            $migrasiKeluar->rt = $penduduk->rt;
            $migrasiKeluar->kelurahan = $penduduk->kelurahan;
            $migrasiKeluar->status_kependudukan = 'Keluar'; // Tambahkan status kependudukan
            $migrasiKeluar->save();

            // Hapus data dari tabel penduduk
            $penduduk->delete();
        } else {
            // Update juga data di tabel migrasi masuk jika status selain 'Keluar'
            $migrasiMasuk = MigrasiMasuk::where('nik', $penduduk->nik)->first();
            if ($migrasiMasuk) {
                $migrasiMasuk->update([
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
                ]);
            }
        }

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

    public function searchPenduduk(Request $request)
    {
        $query = $request->input('query');
        $penduduk = Penduduk::where('nik', $query)
            ->orWhere('nama_lengkap', 'like', '%' . $query . '%')
            ->first();
        if ($penduduk) {
            return response()->json(['exists' => true, 'data' => $penduduk]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function createDied($nik)
    {
        // Ambil data penduduk berdasarkan NIK
        $penduduk = Penduduk::where('nik', $nik)->first();
        // Jika penduduk tidak ditemukan, kembalikan error
        if (!$penduduk) {
            return redirect()->back()->with('error', 'Penduduk tidak ditemukan.');
        }
        // Kirim data penduduk ke view create_died untuk digunakan di form
        return view('create.create_died', [
            'penduduk' => $penduduk,
        ]);
    }






    public function show($id)
    {
        // Logika untuk menampilkan data penduduk berdasarkan ID
        $penduduk = Penduduk::find($id);
        if ($penduduk) {
            return view('penduduk.show', compact('penduduk'));
        } else {
            return redirect()->back()->with('error', 'Penduduk tidak ditemukan');
        }
    }
}
