<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengampuanDosen;

class PengampuanDosenSeeder extends Seeder
{
    public function run()
    {
        PengampuanDosen::insert([
            ['nidn' => '123456', 'kode_mk' => 'PAIK6101'],
            ['nidn' => '123456', 'kode_mk' => 'PAIK6102'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6201'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6202'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6301'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6302'],

            ['nidn' => '789012', 'kode_mk' => 'SI201'],
        ]);
    }
}
