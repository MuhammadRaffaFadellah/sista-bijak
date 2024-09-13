<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    use HasFactory;
    protected $table = 'rw';
    protected $fillable = ['rukun_warga'];
}
