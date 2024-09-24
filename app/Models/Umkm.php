<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;
    protected $table = "umkm"; // Deklarasi nama tabel

    public function user()
    {
        return $this->belongsTo(User::class, 'rw', 'rw_id'); // Pastikan kunci asing benar
    }
}
