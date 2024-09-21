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
        Schema::create('lahir', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kepala_keluarga');
            $table->unsignedBigInteger('nik');
            $table->string('alamat');
            $table->unsignedBigInteger('rw');
            $table->unsignedBigInteger('rt');
            $table->string('nama_ayah_kandung');
            $table->string('nama_ibu_kandung');
            $table->string('nama_anak_lahir');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('status_kependudukan');
            $table->timestamps();

            $table->foreign('rw')->references('id')->on('rw')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lahir');
    }
};
