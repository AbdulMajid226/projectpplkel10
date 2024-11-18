<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Waktu;

class WaktuSeeder extends Seeder
{
    public function run()
    {
        Waktu::insert([
            ['jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00'],
            ['jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00'],

        ]);
    }
}