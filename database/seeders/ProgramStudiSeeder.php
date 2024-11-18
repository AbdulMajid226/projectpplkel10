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
        ]);
    }
}