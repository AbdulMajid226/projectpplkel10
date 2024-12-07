<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Waktu;

class WaktuSeeder extends Seeder
{
    public function run()
    {
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


    }
}
