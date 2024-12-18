<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Waktu;

class WaktuSeeder extends Seeder
{
    public function run()
    {
        // Waktu untuk 3 SKS (2 jam 30 menit)
        Waktu::create([
            'id' => 1,
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '09:30',
        ]);

        Waktu::create([
            'id' => 2,
            'waktu_mulai' => '09:40',
            'waktu_selesai' => '12:10',
        ]);
        Waktu::create([
            'id' => 3,
            'waktu_mulai' => '13:00',
            'waktu_selesai' => '15:30',
        ]);
        Waktu::create([
            'id' => 4,
            'waktu_mulai' => '15:40',
            'waktu_selesai' => '18:10',
        ]);

        // Waktu untuk 4 SKS (3 jam 20 menit)
        Waktu::create([
            'id' => 5,
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '10:20',
        ]);

        Waktu::create([
            'id' => 6,
            'waktu_mulai' => '13:00',
            'waktu_selesai' => '16:20',
        ]);

        // Waktu untuk 2 SKS (1 jam 40 menit)
        Waktu::create([
            'id' => 7,
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '08:40',
        ]);

        Waktu::create([
            'id' => 8,
            'waktu_mulai' => '13:00',
            'waktu_selesai' => '14:40',
        ]);

        Waktu::create([
            'id' => 9,
            'waktu_mulai' => '15:40',
            'waktu_selesai' => '17:20',
        ]);
    }
}