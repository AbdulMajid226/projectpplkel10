<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengambilanIRS;

class PengambilanIRSSeeder extends Seeder
{
    public function run()
    {
        // Untuk mahasiswa semester 1
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 1, // PAIK6101 kelas A
        ]);
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 5, // PAIK6102 kelas A
        ]);

        // Untuk mahasiswa semester 5
        PengambilanIRS::create([
            'id_irs' => 2,
            'id_jadwal' => 2, // PAIK6101 kelas B
        ]);
        PengambilanIRS::create([
            'id_irs' => 2,
            'id_jadwal' => 6, // PAIK6102 kelas B
        ]);
    }
}
