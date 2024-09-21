<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahir extends Model
{
    use HasFactory;

    protected $table = 'lahir'; // Specify the table name if it's not pluralized
    protected $fillable = [
        'nama_kepala_keluarga',
        'nik',
        'alamat',
        'rw',
        'rt',
        'nama_ayah_kandung',
        'nama_ibu_kandung',
        'nama_anak_lahir',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_kependudukan',
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