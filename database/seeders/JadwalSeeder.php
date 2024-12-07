<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        //Semester 1 Tahun Ajaran Ganjil 2022/2023
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6101',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);

        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6102',
            'kode_ruang' => 'E102',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2022/2023',
            'hari' => 'Kamis',
            'waktu_id' => 4,
            'status' => 'Sudah Disetujui'
        ]);


        // Semeter 2 Tahun Ajaran Genap 2022/2023
        Jadwal::create([
            'kode_mk' => 'PAIK6201',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6201',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6201',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6201',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'

        ]);

        Jadwal::create([
            'kode_mk' => 'PAIK6202',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6202',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6202',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'

        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6202',
            'kode_ruang' => 'E102',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2022/2023',
            'hari' => 'Kamis',
            'waktu_id' => 4,
            'status' => 'Sudah Disetujui'
        ]);


        // Semeter 3 Tahun Ajaran Ganjil 2023/2024
        Jadwal::create([
            'kode_mk' => 'PAIK6301',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6301',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6301',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6301',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);

        Jadwal::create([
            'kode_mk' => 'PAIK6302',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6302',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6302',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6302',
            'kode_ruang' => 'E102',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2023/2024',
            'hari' => 'Kamis',
            'waktu_id' => 4,
            'status' => 'Sudah Disetujui'
        ]);


        // Semeter 4 Tahun Ajaran Genap 2023/2024
        Jadwal::create([
            'kode_mk' => 'PAIK6401',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6401',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6401',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6401',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);

        Jadwal::create([
            'kode_mk' => 'PAIK6402',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6402',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6402',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6402',
            'kode_ruang' => 'E102',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Genap 2023/2024',
            'hari' => 'Kamis',
            'waktu_id' => 4,
            'status' => 'Sudah Disetujui'
        ]);


        // Semeter 5 Tahun Ajaran Ganjil 2024/2025
        Jadwal::create([
            'kode_mk' => 'PAIK6501',
            'kode_ruang' => 'E101',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6501',
            'kode_ruang' => 'E101',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Selasa',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6501',
            'kode_ruang' => 'E101',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Rabu',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6501',
            'kode_ruang' => 'E101',
            'kelas' => 'D',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Kamis',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);

        Jadwal::create([
            'kode_mk' => 'PAIK6502',
            'kode_ruang' => 'E102',
            'kelas' => 'A',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Senin',
            'waktu_id' => 1,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6502',
            'kode_ruang' => 'E102',
            'kelas' => 'B',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Selasa',
            'waktu_id' => 3,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6502',
            'kode_ruang' => 'E102',
            'kelas' => 'C',
            'kuota' => 50,
            'thn_ajaran' => 'Ganjil 2024/2025',
            'hari' => 'Rabu',
            'waktu_id' => 2,
            'status' => 'Sudah Disetujui'
        ]);
        Jadwal::create([
            'kode_mk' => 'PAIK6502',
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