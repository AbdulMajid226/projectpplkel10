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
            $table->id('id_mahasiswa');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->decimal('ipk', 3, 2);
            $table->integer('angkatan');
            $table->unsignedBigInteger('id_wali_dosen')->nullable();
            $table->foreign('id_wali_dosen')->references('id_dosen')->on('dosen');
            $table->timestamps();
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