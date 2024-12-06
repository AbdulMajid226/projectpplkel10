<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        //Matkul Matematika I kelas A , B , C , D
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);

        //Matkul Dasar Pemrograman kelas A , B , C , D
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Kamis',
            'waktu_id' => 4,
            'status' => 'Sudah Disetujui'
        ]);
}
}