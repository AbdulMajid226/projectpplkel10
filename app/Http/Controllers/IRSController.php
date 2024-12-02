<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IRS;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class IRSController extends Controller
{
    public function create()
    {
        try {
            // Ambil data mahasiswa yang sedang login
            $mahasiswa = Auth::user()->mahasiswa;

            if (!$mahasiswa) {
                throw new \Exception('Data mahasiswa tidak ditemukan');
            }

            // Ambil semester aktif mahasiswa
            $semesterAktif = $mahasiswa->semester_aktif;

            // Ambil mata kuliah sesuai semester beserta jadwalnya
            $mataKuliah = MataKuliah::with(['jadwal' => function($query) {
                $query->with('waktu'); // Load relasi waktu
            }])
            ->where('semester', $semesterAktif)
            ->where('kode_prodi', $mahasiswa->kode_prodi)
            ->get();

            return view('mahasiswa.buat_irs', [
                'mahasiswa' => $mahasiswa,
                'mataKuliah' => $mataKuliah
            ]);

        } catch (\Exception $e) {
            return view('mahasiswa.buat_irs', [
                'mahasiswa' => null,
                'mataKuliah' => collect([])
            ])->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }
}