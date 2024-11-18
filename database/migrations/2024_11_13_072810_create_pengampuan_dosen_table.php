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
        Schema::create('pengampuan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nidn');
            $table->string('kode_mk');
            
            $table->foreign('nidn')->references('nidn')->on('dosen');
            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliah');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengampuan_dosen');
    }
};