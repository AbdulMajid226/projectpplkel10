<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {

        Jadwal::create([
            'kode_mk' => 'IF101',
            'kode_ruang' => 'E101',
            'kelas' => 'A' ,
            'kuota' => 50 ,
            'thn_ajaran' => '2024/2025',
            'hari' => 'Senin',
            'waktu_id' => 1,
        ]);
        
        Jadwal::create([
            'kode_mk' => 'SI201',
            'kode_ruang' => 'A203',
            'kelas' => 'B' ,
            'kuota' => 50 ,
            'thn_ajaran' => '2024/2025',
            'hari' => 'Selasa',
            'waktu_id' => 2,
        ]);
    }
}