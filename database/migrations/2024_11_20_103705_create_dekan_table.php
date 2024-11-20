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
        Schema::create('dekan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode_fakultas');
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreign('kode_fakultas')->references('kode_fakultas')->on('fakultas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dekan');
    }
};