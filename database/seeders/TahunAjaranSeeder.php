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
            ['thn_ajaran' => 'Genap 2024/2025'],
            ['thn_ajaran' => 'Ganjil 2024/2025'],
            ['thn_ajaran' => 'Genap 2025/2026'],
            ['thn_ajaran' => 'Ganjil 2025/2026'],
        ]);
    }
}