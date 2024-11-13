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
        Schema::create('pembimbing_akademik', function (Blueprint $table) {
            $table->string('nidn')->primary();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_akademik');
    }
};