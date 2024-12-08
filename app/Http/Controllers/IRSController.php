<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IRS;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

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
            if ($status == 'Belum Mengisi') {
                return IRS::with(['mahasiswa' => function($query) {
                    $query->select('nim', 'nama', 'angkatan', 'status');
                }])
                ->where('status_persetujuan', $status)
                ->get();
            }
            return IRS::where('status_persetujuan', $status)->get();
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
            return IRS::where('status_persetujuan', $status)->count();
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
                'pengambilanIrs.jadwal.ruang'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $irs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail IRS: ' . $e->getMessage()
            ], 500);
        }
    }
}
