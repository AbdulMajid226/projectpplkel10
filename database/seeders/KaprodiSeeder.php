<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kaprodi::insert([
            ['nama' => 'Dr. Eko', 'user_id' => 8, 'kode_prodi' => 'IF'],
            ['nama' => 'Dr. Fajar', 'user_id' => 9, 'kode_prodi' => 'TI'],

        ]);
    }
}