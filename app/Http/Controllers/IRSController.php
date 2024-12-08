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

            $jadwal = Jadwal::with(['mataKuliah', 'waktu'])
            ->where('status', 'Sudah Disetujui')
            ->get();

            return view('mahasiswa.buat_irs', [
                'mahasiswa' => $mahasiswa,
                'mataKuliah' => $mataKuliah,
                'jadwal' => $jadwal
            ]);

        } catch (\Exception $e) {
            return redirect()
                ->route('mahasiswa.dashboard')
                ->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function getIRSByStatus($status)
    {
        try {
            $tahunAjaranAktif = 'Ganjil 2024/2025';

            $irsData = IRS::with([
                'mahasiswa' => function($query) {
                    $query->select('nim', 'nama', 'angkatan', 'status');
                },
                'pengambilanIrs.jadwal.mataKuliah' // Tambahkan relasi untuk menghitung SKS
            ])
            ->where('status_persetujuan', $status)
            ->where('thn_ajaran', $tahunAjaranAktif)
            ->get();

            // Hitung total SKS untuk setiap IRS
            foreach($irsData as $irs) {
                $totalSKS = 0;
                foreach($irs->pengambilanIrs as $pengambilan) {
                    if ($pengambilan->jadwal && $pengambilan->jadwal->mata_kuliah) {
                        $totalSKS += $pengambilan->jadwal->mata_kuliah->sks ?? 0;
                    }
                }
                // Update total SKS di database
                $irs->update(['total_sks' => $totalSKS]);
            }

            return $irsData;

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data IRS: ' . $e->getMessage()
            ], 500);
        }
    }

    public function countByStatus($status)
    {
        try {
            $tahunAjaranAktif = 'Ganjil 2024/2025';
            return IRS::where('status_persetujuan', $status)
                      ->where('thn_ajaran', $tahunAjaranAktif)
                      ->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function approve($id)
    {
        try {
            $irs = IRS::findOrFail($id);
            $irs->update([
                'status_persetujuan' => 'Sudah Disetujui',
                'tanggal_persetujuan' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'IRS berhasil disetujui',
                'newCounts' => [
                    'belumMengisi' => $this->countByStatus('Belum Mengisi'),
                    'menungguPersetujuan' => $this->countByStatus('Menunggu Persetujuan'),
                    'disetujui' => $this->countByStatus('Sudah Disetujui')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyetujui IRS: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cancelApproval($id)
    {
        try {
            $irs = IRS::findOrFail($id);
            $irs->update([
                'status_persetujuan' => 'Menunggu Persetujuan',
                'tanggal_persetujuan' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Persetujuan IRS berhasil dibatalkan',
                'newCounts' => [
                    'belumMengisi' => $this->countByStatus('Belum Mengisi'),
                    'menungguPersetujuan' => $this->countByStatus('Menunggu Persetujuan'),
                    'disetujui' => $this->countByStatus('Sudah Disetujui')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan persetujuan IRS: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getDetail($id)
    {
        try {
            $irs = IRS::with([
                'mahasiswa',
                'pengambilanIrs.jadwal.mataKuliah',
                'pengambilanIrs.jadwal.waktu',
            ])->findOrFail($id);

            $totalSKS = 0; // Inisialisasi total SKS

            $jadwalData = $irs->pengambilanIrs->map(function ($pengambilan) use (&$totalSKS) {
                $jadwal = $pengambilan->jadwal;
                $mataKuliah = $jadwal->mataKuliah;
                $waktu = $jadwal->waktu;

                // Tambahkan SKS ke total
                if ($mataKuliah && $mataKuliah->sks) {
                    $totalSKS += $mataKuliah->sks;
                }

                return [
                    'kode_mk' => $mataKuliah ? $mataKuliah->kode_mk : '-',
                    'nama_mk' => $mataKuliah ? $mataKuliah->nama : '-',
                    'sks' => $mataKuliah ? $mataKuliah->sks : '-',
                    'hari' => $jadwal ? $jadwal->hari : '-',
                    'kelas' => $jadwal ? $jadwal->kelas : '-',
                    'jam' => $waktu ? $waktu->waktu_mulai . ' - ' . $waktu->waktu_selesai : '-',
                    'ruangan' => $jadwal ? $jadwal->kode_ruang : '-'
                ];
            });

            // Update total SKS di database
            $irs->update(['total_sks' => $totalSKS]);

            return response()->json([
                'success' => true,
                'data' => [
                    'nama' => $irs->mahasiswa->nama,
                    'nim' => $irs->mahasiswa->nim,
                    'total_sks' => $totalSKS,
                    'jadwal' => $jadwalData
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail IRS: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getTahunAjaranAktif()
    {
        try {
            // Logika untuk mendapatkan tahun ajaran aktif
            // Bisa dari setting sistem atau perhitungan otomatis
            $tahunAjaranAktif = '2024/2025 Ganjil';
            return $tahunAjaranAktif;
        } catch (\Exception $e) {
            return null;
        }
    }

}
