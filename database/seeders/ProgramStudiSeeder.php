<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;


class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStudi::insert([
            ['kode_prodi' => 'IF', 'nama_prodi' => 'Informatika', 'kode_fakultas' => 'FK001'],
            ['kode_prodi' => 'SI', 'nama_prodi' => 'Sistem Informasi', 'kode_fakultas' => 'FK002'],
            ['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Industri', 'kode_fakultas' => 'FK002'],
            ['kode_prodi' => 'MTK', 'nama_prodi' => 'Matematika', 'kode_fakultas' => 'FK001'],
            ['kode_prodi' => 'ELK', 'nama_prodi' => 'Teknik Elektro', 'kode_fakultas' => 'FK002'],
            ['kode_prodi' => 'ARS', 'nama_prodi' => 'Arsitektur', 'kode_fakultas' => 'FK002'],
            ['kode_prodi' => 'FIS', 'nama_prodi' => 'Fisika', 'kode_fakultas' => 'FK001'],
            ['kode_prodi' => 'BIO', 'nama_prodi' => 'Biologi', 'kode_fakultas' => 'FK001'],
        ]);
    }
}