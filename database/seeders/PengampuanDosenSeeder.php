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
            ['nidn' => '123456', 'kode_mk' => 'PAIK6101'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6102'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6103'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6104'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6105'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6101'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6102'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6103'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6104'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6105'],

            ['nidn' => '223456', 'kode_mk' => 'PAIK6201'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6202'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6203'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6204'],

            ['nidn' => '323456', 'kode_mk' => 'PAIK6301'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6302'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6303'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6304'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6305'],
            ['nidn' => '323456', 'kode_mk' => 'PAIK6306'],

            ['nidn' => '423456', 'kode_mk' => 'PAIK6401'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6402'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6403'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6404'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6405'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6406'],

            ['nidn' => '523456', 'kode_mk' => 'PAIK6501'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6501'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6502'],
            ['nidn' => '123456', 'kode_mk' => 'PAIK6502'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6503'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6504'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6505'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6506'],
            ['nidn' => '223456', 'kode_mk' => 'PAIK6506'],
            ['nidn' => '423456', 'kode_mk' => 'PAIK6507'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6508'],
            ['nidn' => '723456', 'kode_mk' => 'PAIK6508'],
            ['nidn' => '523456', 'kode_mk' => 'PAIK6509'],

            ['nidn' => '623456', 'kode_mk' => 'PAIK6601'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6602'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6603'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6604'],
            ['nidn' => '623456', 'kode_mk' => 'PAIK6605'],

            ['nidn' => '723456', 'kode_mk' => 'PAIK6701'],
            ['nidn' => '723456', 'kode_mk' => 'PAIK6702'],

            ['nidn' => '823456', 'kode_mk' => 'PAIK6801'],

            ['nidn' => '789012', 'kode_mk' => 'SI201'],
        ]);
    }
}