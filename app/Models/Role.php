<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // berfungsi untuk melarang isian atribut tertentu pada method
    // Role::create() ketika menginput data pada terminal
    protected $guarded = ['id'];
    
    public function user(){
        //Hubungan one to many
        //satu Role memiliki banyak User
        return $this->hasMany(User::class,'user_id');
    }

}
