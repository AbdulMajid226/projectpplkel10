<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run()
    {
        Dosen::insert([
            ['nidn' => '123456', 'nama' => 'Dr. John Doe', 'kode_prodi' => 'IF'],
            ['nidn' => '789012', 'nama' => 'Prof. Jane Smith', 'kode_prodi' => 'SI'],
        ]);
    }
}