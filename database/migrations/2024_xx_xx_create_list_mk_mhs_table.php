<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('list_mk_mhs', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('kode_mk');
            $table->integer('semester');
            $table->string('status')->default('draft'); // draft, selected
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliah')->onDelete('cascade');
            
            // Mencegah duplikasi data
            $table->unique(['nim', 'kode_mk']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('list_mk_mhs');
    }
}; 