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
            $table->foreignId('nidn')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('kode_mk')->constrained('mata_kuliah')->onDelete('cascade');
            
            $table->primary(['nidn', 'kode_mk']);
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