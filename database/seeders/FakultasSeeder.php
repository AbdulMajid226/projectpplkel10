<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::insert([
            ['kode_fakultas' => 'FK001', 'nama' => 'Fakultas Sains dan Matematika'],
            ['kode_fakultas' => 'FK002', 'nama' => 'Fakultas Teknik'],
        ]);
    }
}