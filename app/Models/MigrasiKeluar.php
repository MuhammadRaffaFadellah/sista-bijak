<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrasiKeluar extends Model
{
    use HasFactory;

    protected $table = 'migrasi_keluar';

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
        return $this->belongsTo(Rw::class, 'rw');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rw', 'rw_id'); // Pastikan kunci asing benar
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'nik', 'nik');
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($migrasi) {
            $penduduk = Penduduk::where('nik', $migrasi->nik)->first();
            if ($penduduk) {
                $penduduk->update($migrasi->getAttributes());
            }
        });

        static::deleting(function ($migrasi) {
            Penduduk::where('nik', $migrasi->nik)->delete();
        });
    }
}