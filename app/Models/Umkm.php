<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Umkm extends Model
{
    use HasFactory;

    protected $table = "umkm"; // Deklarasi nama tabel

    // Tambahkan properti fillable
    protected $fillable = [
        'nama_rw',
        'rw',
        'jumlah_umkm',
        'kategori_umkm',
        'jenis_umkm',
        'nama_pemilik',
        'nik',
        'alamat',
    ];

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rw', 'rw_id'); // Pastikan kunci asing benar
    }
}
