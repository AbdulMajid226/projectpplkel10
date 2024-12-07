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
        Schema::create('pengambilan_irs', function (Blueprint $table) {
            $table->foreignId('id_irs')->constrained('irs')->onDelete('cascade');
            $table->foreignId('id_jadwal')->constrained('jadwal')->onDelete('cascade');
            $table->enum('status_pengambilan', ['Baru', 'Perbaikan', 'Mengulang'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengambilan_irs');
    }
};