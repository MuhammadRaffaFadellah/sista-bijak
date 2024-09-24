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
}
