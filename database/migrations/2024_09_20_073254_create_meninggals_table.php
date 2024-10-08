<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meninggals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik');
            $table->string('nama_almarhum');
            $table->string('hubungan_dengan_kk');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('rw');
            $table->unsignedBigInteger('rt');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('tempat_meninggal');
            $table->date('tanggal_meninggal');
            $table->string('alamat');
            $table->string('status_kependudukan'); 
            $table->timestamps();

            $table->foreign('rw')->references('id')->on('rw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meninggals');
    }
};
