<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meninggals extends Model
{
    use HasFactory;

    protected $table = 'meninggals';
    protected $fillable = [
        'nama_kepala_keluarga',
        'nik',
        'alamat',
        'rw',
        'rt',
        'nama_almarhum',
        'hubungan_dengan_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'tempat_meninggal',
        'tanggal_meninggal',
        'jenis_kelamin',
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
