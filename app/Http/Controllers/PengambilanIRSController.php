<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IRS;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\PengambilanIRS;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengambilanIRSController extends Controller
{
    public function getDetail($id)
    {
        try {
            $irs = PengambilanIRS::with(['irs.mahasiswa', 'jadwal.mataKuliah', 'jadwal.waktu'])
                ->where('id', $id)
                ->firstOrFail();

            $jadwal = $irs->jadwal->map(function ($item) {
                return [
                    'kode_mk' => $item->kode_mk ?? '-',
                    'nama_mk' => $item->mataKuliah->nama ?? 'Tidak Terdaftar',
                    'sks' => $item->sks ?? 0,
                'hari' => $item->waktu->hari ?? 'Belum Dijadwalkan',
                    'jam' => $item->waktu->jam ?? 'Belum Dijadwalkan',
                    'ruangan' => $item->ruangan ?? 'Belum Ditentukan',
                ];
            });

            return response()->json([
                'nama' => $irs->mahasiswa->nama,
                'nim' => $irs->mahasiswa->nim,
                'jadwal' => $jadwal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memuat detail IRS.',
                'error' => $e->getMessage(),  // Debugging pesan error

            ], 500);
        }
    }
}

