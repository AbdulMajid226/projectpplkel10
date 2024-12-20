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
        Schema::create('ruang', function (Blueprint $table) {
            $table->string('kode_ruang')->primary();
            $table->integer('kuota');
            $table->string('kode_prodi');
            $table->string('kode_fakultas');
            $table->enum('status', ['BelumDisetujui', 'disetujui', 'ditolak'])->default('BelumDisetujui');

            $table->foreign('kode_prodi')->references('kode_prodi')->on('program_studi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang');
    }
};
