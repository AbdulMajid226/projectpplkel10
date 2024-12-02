<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PembimbingAkademik;

class PembimbingAkademikSeeder extends Seeder
{
    public function run()
    {
        PembimbingAkademik::insert([
            ['nidn' => '123456', 'nama' => 'Dr. John Doe', 'user_id' => 1],
        ]);
    }
}