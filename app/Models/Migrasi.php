<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migrasi extends Model
{
    use HasFactory;

    protected $table = 'migrasi';

    protected $fillable = [
        'jenis_migrasi',
        'nama_kepala_keluarga',
        'nik',
        'rw',
        'rt',
        'status',
    ];

    public function anggotaMigrasi()
    {
        return $this->hasMany(AnggotaMigrasi::class);
    }
}