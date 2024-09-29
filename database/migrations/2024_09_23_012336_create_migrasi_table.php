<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMigrasiTable extends Migration
{
    public function up()
    {
        Schema::create('migrasi', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_migrasi', ['masuk', 'keluar']);
            $table->string('nama_kepala_keluarga');
            $table->string('nik')->unique();
            $table->unsignedBigInteger('rw');
            $table->unsignedBigInteger('rt');
            $table->timestamps();
        });
        Schema::create('anggota_migrasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('migrasi_id');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->string('hubungan_dengan_kk');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->timestamps();

            $table->foreign('migrasi_id')->references('id')->on('migrasi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota_migrasi');
        Schema::dropIfExists('migrasi');
    }
}