<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function umkm_table(){
        return view("/umkm-table");
    }
}
