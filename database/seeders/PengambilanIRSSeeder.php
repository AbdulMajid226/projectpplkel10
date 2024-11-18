<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengambilanIRS;

class PengambilanIRSSeeder extends Seeder
{
    public function run()
    {
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 1,
        ]);
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 2,
        ]);
    }
}