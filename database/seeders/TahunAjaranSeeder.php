<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        TahunAjaran::insert([
            ['thn_ajaran' => 'Ganjil 2022/2023'],
            ['thn_ajaran' => 'Genap 2022/2023'],
            ['thn_ajaran' => 'Ganjil 2023/2024'],
            ['thn_ajaran' => 'Genap 2023/2024'],
            ['thn_ajaran' => 'Ganjil 2024/2025'],

        ]);
    }
}
