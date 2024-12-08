<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListMkMhs;
use App\Models\PengambilanIRS;
use App\Models\Jadwal;

class ListMkMhsSeeder extends Seeder
{
    public function run()
    {
        // Mengambil data dari PengambilanIRS untuk Alice
        $pengambilanIRSData = PengambilanIRS::with(['irs', 'jadwal'])->get();

        foreach ($pengambilanIRSData as $pengambilanIRS) {
            ListMkMhs::create([
                'nim' => $pengambilanIRS->irs->nim,
                'kode_mk' => $pengambilanIRS->jadwal->kode_mk,
                'semester' => $pengambilanIRS->irs->semester,
                'status' => $pengambilanIRS->status_pengambilan
            ]);
        }
    }
} 