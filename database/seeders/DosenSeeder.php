<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run()
    {
        Dosen::insert([
            ['nidn' => '123456', 'nama' => 'Dr. John Doe', 'kode_prodi' => 'IF'],
            ['nidn' => '223456', 'nama' => 'Dr. Kenal Luu', 'kode_prodi' => 'IF'],
            ['nidn' => '323456', 'nama' => 'Dr. Sena Joe', 'kode_prodi' => 'IF'],
            ['nidn' => '789012', 'nama' => 'Prof. Jane Smith', 'kode_prodi' => 'SI'],
            ['nidn' => '112233', 'nama' => 'Dr. Henry Ford', 'kode_prodi' => 'TI'],
            ['nidn' => '445566', 'nama' => 'Dr. Albert Einstein', 'kode_prodi' => 'MTK'],
            ['nidn' => '998877', 'nama' => 'Dr. Mary Curie', 'kode_prodi' => 'ELK'],
            ['nidn' => '665544', 'nama' => 'Prof. Nikola Tesla', 'kode_prodi' => 'FIS'],
            ['nidn' => '776655', 'nama' => 'Dr. Rosalind Franklin', 'kode_prodi' => 'BIO'],
            ['nidn' => '334455', 'nama' => 'Prof. Michael Porter', 'kode_prodi' => 'KEU'],
        ]);
    }
}