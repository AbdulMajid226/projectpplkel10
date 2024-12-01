<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruang;

class RuangSeeder extends Seeder
{
    public function run()
    {
        Ruang::insert([
            ['kode_ruang' => 'E101', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'Sudah Disetujui'],
            ['kode_ruang' => 'E102', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'Belum Disetujui'],
            ['kode_ruang' => 'E103', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'Ditolak'],
            ['kode_ruang' => 'A203', 'kuota' => 50, 'kode_prodi' => 'SI', 'status' => 'Sudah Disetujui'],
            ['kode_ruang' => 'A303', 'kuota' => 50, 'kode_prodi' => 'MTK', 'status' => 'Belum Disetujui'],
        ]);
    }
}