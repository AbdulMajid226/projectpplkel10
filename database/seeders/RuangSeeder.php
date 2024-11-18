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
            ['kode_ruang' => 'E101', 'kuota' => 50, 'kode_prodi' => 'IF'],
            ['kode_ruang' => 'A203', 'kuota' => 50, 'kode_prodi' => 'SI'],
        ]);
    }
}