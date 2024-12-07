<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IRS;

class IRSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Alice Semester 1-4 (Sudah Disetujui)
        IRS::create([
            'nim' => '24060122130001',
            'semester' => 1,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'status_persetujuan' => 'Sudah Disetujui',
            'tanggal_persetujuan' => null,
        ]);

        IRS::create([
            'nim' => '24060122130001',
            'semester' => 2,
            'thn_ajaran' => 'Genap 2022/2023',
            'status_persetujuan' => 'Sudah Disetujui',
            'tanggal_persetujuan' => null,
        ]);

        IRS::create([
            'nim' => '24060122130001',
            'semester' => 3,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'status_persetujuan' => 'Sudah Disetujui',
            'tanggal_persetujuan' => null,
        ]);

        IRS::create([
            'nim' => '24060122130001',
            'semester' => 4,
            'thn_ajaran' => 'Genap 2023/2024',
            'status_persetujuan' => 'Sudah Disetujui',
            'tanggal_persetujuan' => null,
        ]);

        // Alice Semester 5 (Menunggu Persetujuan)
        IRS::create([
            'nim' => '24060122130001',
            'semester' => 5,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'status_persetujuan' => 'Menunggu Persetujuan',
            'tanggal_persetujuan' => null,
        ]);

        // Bob Semester 5 (Belum Mengisi)
        IRS::create([
            'nim' => '24060122130002',
            'semester' => 5,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'status_persetujuan' => 'Belum Mengisi',
            'tanggal_persetujuan' => null,
        ]);
    }
}
