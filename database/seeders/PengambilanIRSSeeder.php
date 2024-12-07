<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengambilanIRS;

class PengambilanIRSSeeder extends Seeder
{
    public function run()
    {
        // Alice Semester 1
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 1,
            'status_pengambilan' => 'Baru',
        ]);
        PengambilanIRS::create([
            'id_irs' => 1,
            'id_jadwal' => 5,
            'status_pengambilan' => 'Baru',
        ]);

        // Alice Semester 2
        PengambilanIRS::create([
            'id_irs' => 2,
            'id_jadwal' => 9,
            'status_pengambilan' => 'Baru',
        ]);
        PengambilanIRS::create([
            'id_irs' => 2,
            'id_jadwal' => 13,
            'status_pengambilan' => 'Baru',
        ]);

        // Alice Semester 3
        PengambilanIRS::create([
            'id_irs' => 3,
            'id_jadwal' => 17,
            'status_pengambilan' => 'Baru',
        ]);
        PengambilanIRS::create([
            'id_irs' => 3,
            'id_jadwal' => 21,
            'status_pengambilan' => 'Baru',
        ]);

        // Alice Semester 4
        PengambilanIRS::create([
            'id_irs' => 4,
            'id_jadwal' => 25,
            'status_pengambilan' => 'Baru',
        ]);
        PengambilanIRS::create([
            'id_irs' => 4,
            'id_jadwal' => 29,
            'status_pengambilan' => 'Baru',
        ]);

        // Alice Semester 5
        PengambilanIRS::create([
            'id_irs' => 5,
            'id_jadwal' => 33,
            'status_pengambilan' => 'Baru',
        ]);
        PengambilanIRS::create([
            'id_irs' => 5,
            'id_jadwal' => 37,
            'status_pengambilan' => 'Baru',
        ]);
    }
}
