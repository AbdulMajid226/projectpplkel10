<?php

namespace Database\Seeders;

use App\Models\Dekan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dekan::insert([
            ['nama' => 'Dr. Ir. Ahmad', 'user_id' => 6, 'kode_fakultas' => 'FK001'],
            ['nama' => 'Prof. Bambang', 'user_id' => 7, 'kode_fakultas' => 'FK002'],
        ]);
    }
}