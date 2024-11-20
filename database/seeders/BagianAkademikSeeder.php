<?php

namespace Database\Seeders;

use App\Models\BagianAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagianAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BagianAkademik::insert([
            ['nama' => 'Admin Sains dan Matematika', 'user_id' => 4, 'kode_fakultas' => 'FK001'],
            ['nama' => 'Admin Teknik', 'user_id' => 5, 'kode_fakultas' => 'FK002'],

        ]);
    }
}