<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KuotaKelas;

class KuotaKelasSeeder extends Seeder
{
    public function run()
    {
        KuotaKelas::insert([
            ['kuota' => 50],
            ['kuota' => 40],
            ['kuota' => 30],
            ['kuota' => 25],
        ]);
    }
}