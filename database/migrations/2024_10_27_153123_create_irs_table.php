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
        Schema::create('irs', function (Blueprint $table) {
            $table->id('id_irs');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->unsignedBigInteger('id_dosen');
            $table->string('status_persetujuan')->default('Belum Disetujui');
            $table->string('semester');
            $table->year('tahun_ajaran');
            $table->date('tanggal_persetujuan')->nullable();
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_mata_kuliah')->references('id_mata_kuliah')->on('mata_kuliah');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};