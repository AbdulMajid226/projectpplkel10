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
            ['kode_ruang' => 'E101', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E102', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E103', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E104', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E105', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E106', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E107', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E108', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'E109', 'kuota' => 50, 'kode_prodi' => 'IF', 'kode_fakultas' => 'FK001', 'status' => 'disetujui'],
            ['kode_ruang' => 'A203', 'kuota' => 50, 'kode_prodi' => 'SI', 'kode_fakultas' => 'FK002', 'status' => 'disetujui'],
            ['kode_ruang' => 'A303', 'kuota' => 50, 'kode_prodi' => 'MTK', 'kode_fakultas' => 'FK001', 'status' => 'BelumDisetujui'],
        ]);
    }
}