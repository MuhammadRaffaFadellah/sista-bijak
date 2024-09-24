<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaMigrasi extends Model
{
    use HasFactory;

    protected $table = 'anggota_migrasi';

    protected $fillable = [
        'migrasi_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'hubungan_dengan_kk',
        'pendidikan',
        'pekerjaan',
    ];

    public function migrasi()
    {
        return $this->belongsTo(Migrasi::class);
    }
}