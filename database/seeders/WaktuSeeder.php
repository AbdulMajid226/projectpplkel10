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
            ['jam_mulai' => '07:00:00', 'jam_selesai' => '09:30:00'],
            ['jam_mulai' => '09:40:00', 'jam_selesai' => '12:10:00'],
            ['jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00'],
            ['jam_mulai' => '15:40:00', 'jam_selesai' => '18:10:00'],
        ]);
    }
}