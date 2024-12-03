<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        Mahasiswa::insert([
            [
                'nim' => '24060122130001',
                'nama' => 'Alice',
                'angkatan' => 2024,
                'kode_prodi' => 'IF',
                'nidn' => '123456',
                'user_id' => 2,
                'status' => 'BelumRegistrasi',
                'semester_aktif' => 1
            ],
            [
                'nim' => '24060122130002',
                'nama' => 'Bob',
                'angkatan' => 2022,
                'kode_prodi' => 'SI',
                'nidn' => '123456',
                'user_id' => 3,
                'status' => 'BelumRegistrasi',
                'semester_aktif' => 5
            ],
        ]);
    }
}