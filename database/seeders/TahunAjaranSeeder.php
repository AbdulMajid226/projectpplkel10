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
            ['thn_ajaran' => '2024/2025'],
        ]);
    }
}