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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('kode_mk');
            $table->string('kode_ruang');
            $table->string('kelas');
            $table->integer('kuota');
            $table->string('thn_ajaran');
            $table->string('hari');
            $table->timestamps();

            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('ruang')->onDelete('cascade');
            $table->foreign('kelas')->references('kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('kuota')->references('kuota')->on('kuota_kelas')->onDelete('cascade');
            $table->foreign('thn_ajaran')->references('thn_ajaran')->on('tahun_ajaran_')->onDelete('cascade');
            $table->foreignId(column: 'waktu')->constrained('waktu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};