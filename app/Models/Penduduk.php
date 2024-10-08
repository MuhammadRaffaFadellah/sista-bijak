<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_hubkel',
        'pendidikan_terakhir',
        'jenis_pekerjaan',
        'agama',
        'status_perkawinan',
        'alamat',
        'rw',
        'rt',
        'kelurahan',
        'status_kependudukan',
    ];

    // Define the relationship with Rw
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rw', 'rw_id'); // Pastikan kunci asing benar
    }
    // Define the relationship with Jk
    // public function rt()
    // {
    //     return $this->belongsTo(Rt::class, 'rt_id');
    // }
}
