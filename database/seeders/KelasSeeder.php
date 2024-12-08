<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::insert([
            ['kelas' => 'A'],
            ['kelas' => 'B'],
            ['kelas' => 'C'],
            ['kelas' => 'D'],
            ['kelas' => 'E'],
            ['kelas' => 'F'],
        ]);
    }
}