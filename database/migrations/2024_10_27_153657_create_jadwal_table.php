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
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruang');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->unsignedBigInteger('id_dosen');
            $table->timestamps();
    
            $table->foreign('id_mata_kuliah')->references('id_mata_kuliah')->on('mata_kuliah');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
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