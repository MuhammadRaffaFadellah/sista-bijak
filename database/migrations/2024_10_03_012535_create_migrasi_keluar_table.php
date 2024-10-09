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
        Schema::create('migrasi_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_hubkel');
            $table->string('pendidikan_terakhir');
            $table->string('jenis_pekerjaan')->nullable();
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('alamat');
            $table->unsignedBigInteger('rw');
            $table->unsignedBigInteger('rt');
            $table->string('kelurahan');
            $table->string('status_kependudukan');
            $table->timestamps();
    
            $table->foreign('penduduk_id')->references('id')->on('penduduk')->onDelete('cascade');
            $table->foreign('rw')->references('id')->on('rw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migrasi_keluar');
    }
};
