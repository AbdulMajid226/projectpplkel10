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
            ['nidn' => '123456', 'kode_mk' => 'IF101'],
            ['nidn' => '123456', 'kode_mk' => 'IF102'],
            ['nidn' => '223456', 'kode_mk' => 'IF201'],
            ['nidn' => '223456', 'kode_mk' => 'IF202'],
            ['nidn' => '323456', 'kode_mk' => 'IF301'],
            ['nidn' => '323456', 'kode_mk' => 'IF302'],
            
            ['nidn' => '789012', 'kode_mk' => 'SI201'],
        ]);
    }
}