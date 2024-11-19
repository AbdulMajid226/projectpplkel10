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
            ['kode_prodi' => 'IF', 'nama_prodi' => 'Informatika'],
            ['kode_prodi' => 'SI', 'nama_prodi' => 'Sistem Informasi'],
            ['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Industri'],
            ['kode_prodi' => 'MTK', 'nama_prodi' => 'Matematika'],
            ['kode_prodi' => 'ELK', 'nama_prodi' => 'Teknik Elektro'],
            ['kode_prodi' => 'ARS', 'nama_prodi' => 'Arsitektur'],
            ['kode_prodi' => 'FIS', 'nama_prodi' => 'Fisika'],
            ['kode_prodi' => 'BIO', 'nama_prodi' => 'Biologi'],
            ['kode_prodi' => 'KEU', 'nama_prodi' => 'Keuangan'],
            ['kode_prodi' => 'AKT', 'nama_prodi' => 'Akuntansi'],
        ]);
    }
}