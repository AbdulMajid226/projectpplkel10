<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        MataKuliah::insert([
            ['kode_mk' => 'PAIK6101', 'nama' => 'Matematika I', 'sks' => 2, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6102', 'nama' => 'Dasar Pemrograman', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6103', 'nama' => 'Dasar Sistem', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6104', 'nama' => 'Logika Informatika', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6105', 'nama' => 'Struktur Diskrit', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6201', 'nama' => 'Matematika II', 'sks' => 2, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6202', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6203', 'nama' => 'Organisasi dan Arsitektur Komputer', 'sks' => 3, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6204', 'nama' => 'Aljabar Linear', 'sks' => 3, 'semester' => 2, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6301', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6302', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6303', 'nama' => 'Basis Data', 'sks' => 4, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6304', 'nama' => 'Metode Numerik', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6305', 'nama' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6306', 'nama' => 'Statistika', 'sks' => 2, 'semester' => 3, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6401', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6402', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6403', 'nama' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6404', 'nama' => 'Grafika dan Komputasi Visual', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6405', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6406', 'nama' => 'Sistem Cerdas', 'sks' => 3, 'semester' => 4, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6501', 'nama' => 'Pengembangan Berbasis Platform', 'sks' => 4, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6502', 'nama' => 'Komputasi Tersebar dan Pararel', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6503', 'nama' => 'Sistem Informasi', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6504', 'nama' => 'Proyek Perangkat Lunak', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6505', 'nama' => 'Pembelajaran Mesin', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6506', 'nama' => 'Keamanan dan Jaminan Informasi', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6507', 'nama' => 'Analisis Data', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6508', 'nama' => 'Pengembangan Aplikasi Mobile', 'sks' => 4, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6509', 'nama' => 'Cloud Computing', 'sks' => 3, 'semester' => 5, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6601', 'nama' => 'Analisis dan Strategi Algoritma', 'sks' => 3, 'semester' => 6, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6602', 'nama' => 'Uji Perangkat Lunak', 'sks' => 3, 'semester' => 6, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6603', 'nama' => 'Masyarakat dan Etika Profesi', 'sks' => 3, 'semester' => 6, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6604', 'nama' => 'Praktik Kerja Lapangan', 'sks' => 3, 'semester' => 6, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6605', 'nama' => 'Manajemen Proyek', 'sks' => 3, 'semester' => 6, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6701', 'nama' => 'Metodologi dan Penulisan Ilmiah', 'sks' => 2, 'semester' => 7, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],
            ['kode_mk' => 'PAIK6702', 'nama' => 'Teori Bahasa dan Otomata', 'sks' => 3, 'semester' => 7, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],

            ['kode_mk' => 'PAIK6801', 'nama' => 'Tugas Akhir', 'sks' => 6, 'semester' => 8, 'sifat' => 'wajib', 'kode_prodi' => 'IF'],


            ['kode_mk' => 'MTK101', 'nama' => 'Matematika Dasar', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],
            ['kode_mk' => 'MTK102', 'nama' => 'Kalkulus', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],
            ['kode_mk' => 'SMTK103', 'nama' => 'Matematika 2', 'sks' => 3, 'semester' => 1, 'sifat' => 'wajib', 'kode_prodi' => 'MTK'],

            ['kode_mk' => 'SI201', 'nama' => 'Analisis Sistem', 'sks' => 2, 'semester' => 2, 'sifat' => 'pilihan', 'kode_prodi' => 'SI'],

        ]);
    }
}