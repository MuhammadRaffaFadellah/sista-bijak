<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rt extends Model
{
    use HasFactory;
    protected $table = 'rt';
    protected $fillable = ['nama'];

    public function rw(){
        //Hubungan one to one
        //satu User memiliki satu Rw
        return $this->belongsTo(rw::class,'rw_id');
    }
}


