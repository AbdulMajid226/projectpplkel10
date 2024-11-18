<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        MataKuliah::insert([
            ['kode_mk' => 'IF101', 'nama' => 'Pemrograman Dasar', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'SI201', 'nama' => 'Analisis Sistem', 'sks' => 2, 'semester' => 2, 'sifat' => 'pilihan', 'kode_prodi' => 'SI'],
        ]);
    }
}