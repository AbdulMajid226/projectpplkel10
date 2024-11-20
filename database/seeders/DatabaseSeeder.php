<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            FakultasSeeder::class,
            ProgramStudiSeeder::class,
            DosenSeeder::class,
            PembimbingAkademikSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
            PengampuanDosenSeeder::class,
            RuangSeeder::class,
            KuotaKelasSeeder::class,
            KelasSeeder::class,
            TahunAjaranSeeder::class,
            WaktuSeeder::class,
            IRSSeeder::class,
            JadwalSeeder::class,
            PengambilanIRSSeeder::class,
            BagianAkademikSeeder::class,
            DekanSeeder::class,
            KaprodiSeeder::class,
        ]);
    }
}