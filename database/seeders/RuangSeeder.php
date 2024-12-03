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
            ['kode_ruang' => 'E101', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'disetujui'],
            ['kode_ruang' => 'E102', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'BelumDisetujui'],
            ['kode_ruang' => 'E103', 'kuota' => 50, 'kode_prodi' => 'IF', 'status' => 'ditolak'],
            ['kode_ruang' => 'A203', 'kuota' => 50, 'kode_prodi' => 'SI', 'status' => 'disetujui'],
            ['kode_ruang' => 'A303', 'kuota' => 50, 'kode_prodi' => 'MTK', 'status' => 'BelumDisetujui'],
        ]);
    }
}