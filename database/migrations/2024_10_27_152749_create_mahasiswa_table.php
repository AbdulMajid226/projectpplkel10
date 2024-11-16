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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->year('angkatan');
            $table->string('kode_prodi');
            $table->string('nidn');
            $table->timestamps();

            $table->foreign('kode_prodi')->references('kode_prodi')->on('program_studi');   
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreign('nidn')->references('nidn')->on('pembimbing_akademik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};