<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function importData()
    {
        try {
            // Import data menggunakan class WaliMuridsImport
            Excel::import(new PendudukImport, request()->file('your_file'));

            // Redirect dengan pesan sukses
            return redirect('/import')->with('success', 'Berhasil Import Data');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect('/import')->with('error', 'Gagal Import Data: ' . $e->getMessage());
        }
    }
    public function index()
    {
    // Menghitung total jumlah user
    $totalPenduduk = Penduduk::count();
    // Menghitung total user laki-laki
    $totalLakiLaki = Penduduk::where('jenis_kelamin', 'LAKI-LAKI')->count();
    // Menghitung total user perempuan
    $totalPerempuan = Penduduk::where('jenis_kelamin', 'PEREMPUAN')->count();

    $proporsiLK = number_format(($totalLakiLaki / $totalPenduduk) * 100, 2);
    $proporsiPR = number_format(($totalPerempuan / $totalPenduduk) * 100, 2);
    return view('dashboard', compact('totalPenduduk', 'totalLakiLaki', 'totalPerempuan', 'proporsiLK', 'proporsiPR'));
    }
}
