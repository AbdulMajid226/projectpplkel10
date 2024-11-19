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
            ['kode_mk' => 'IF101', 'nama' => 'Dasar Pemrograman', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'IF102', 'nama' => 'Dasar Sistem', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'IF201', 'nama' => 'Algoritma Pemrograman', 'sks' => 3, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'IF202', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'IF301', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'IF302', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            
            ['kode_mk' => 'MTK101', 'nama' => 'Matematika Dasar', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],
            ['kode_mk' => 'MTK102', 'nama' => 'Kalkulus', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],
            ['kode_mk' => 'SMTK103', 'nama' => 'Matematika 2', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],

            ['kode_mk' => 'SI201', 'nama' => 'Analisis Sistem', 'sks' => 2, 'semester' => 2, 'sifat' => 'pilihan', 'kode_prodi' => 'SI'],
            
        ]);
    }
}