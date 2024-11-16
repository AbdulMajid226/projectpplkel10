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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->string('kode_mk')->primary();
            $table->string('nama');
            $table->integer('sks');
            $table->integer('semester');
            $table->enum('sifat', ['wajib', 'pilihan']);
            $table->string('kode_prodi');
            
            $table->foreign('kode_prodi')->references('kode_prodi')->on('program_studi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};