<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IRS;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\PengambilanIRS;
use App\Models\ListMkMhs;

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
                $query->with(['waktu', 'ruang'])
                      ->where('status', 'Sudah Disetujui');
            }])
            ->where('semester', $semesterAktif)
            ->where('kode_prodi', $mahasiswa->kode_prodi)
            ->get();

            // Ambil semua jadwal yang sudah disetujui
            $jadwal = Jadwal::with(['mataKuliah', 'waktu', 'ruang'])
                            ->where('status', 'Sudah Disetujui')
                            ->get();

            // Hitung kuota terisi untuk setiap jadwal
            $kuotaTerisi = PengambilanIRS::select('id_jadwal')
                            ->selectRaw('count(*) as total')
                            ->groupBy('id_jadwal')
                            ->pluck('total', 'id_jadwal')
                            ->toArray();

            // Ambil jadwal yang sudah dipilih oleh mahasiswa
            $jadwalDipilih = PengambilanIRS::whereHas('irs', function($query) use ($mahasiswa) {
                $query->where('nim', $mahasiswa->nim)
                      ->where('semester', $mahasiswa->semester_aktif);
            })->pluck('id_jadwal')->toArray();

            // Kirim data jadwal dengan format yang benar dan informasi kuota
            $jadwalData = $jadwal->map(function($j) use ($kuotaTerisi, $jadwalDipilih) {
                return [
                    'id' => $j->id,
                    'kode_mk' => $j->kode_mk,
                    'nama_mk' => $j->mataKuliah->nama,
                    'hari' => $j->hari,
                    'waktu_mulai' => $j->waktu->waktu_mulai,
                    'waktu_selesai' => $j->waktu->waktu_selesai,
                    'kelas' => $j->kelas,
                    'ruang' => $j->ruang->kode_ruang,
                    'kuota' => $j->kuota,
                    'kuota_terisi' => $kuotaTerisi[$j->id] ?? 0,
                    'is_selected' => in_array($j->id, $jadwalDipilih)
                ];
            });

            return view('mahasiswa.buat_irs', [
                'mahasiswa' => $mahasiswa,
                'mataKuliah' => $mataKuliah,
                'jadwal' => $jadwalData
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

    public function storePengambilanIRS(Request $request)
    {
        try {
            $mahasiswa = Auth::user()->mahasiswa;

            // Cek apakah sudah ada IRS untuk semester ini
            $irs = IRS::where('nim', $mahasiswa->nim)
                      ->where('semester', $mahasiswa->semester_aktif)
                      ->first();

            // Jika belum ada, buat IRS baru
            if (!$irs) {
                $irs = IRS::create([
                    'nim' => $mahasiswa->nim,
                    'semester' => $mahasiswa->semester_aktif,
                    'thn_ajaran' => $mahasiswa->tahun_ajaran_aktif,
                    'status_persetujuan' => 'Menunggu Persetujuan'
                ]);
            }

            // Simpan pengambilan jadwal
            $pengambilanIRS = PengambilanIRS::create([
                'id_irs' => $irs->id,
                'id_jadwal' => $request->jadwal_id,
                'status_pengambilan' => 'Baru'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dipilih'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memilih jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeListMK(Request $request)
    {
        try {
            $mahasiswa = Auth::user()->mahasiswa;
            $mataKuliah = MataKuliah::findOrFail($request->kode_mk);
            
            ListMkMhs::updateOrCreate(
                [
                    'nim' => $mahasiswa->nim, 
                    'kode_mk' => $request->kode_mk
                ],
                [
                    'semester' => $mahasiswa->semester_aktif,
                    'status' => 'draft'
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil ditambahkan ke list'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteListMK($kode_mk)
    {
        try {
            $nim = Auth::user()->mahasiswa->nim;
            
            ListMkMhs::where('nim', $nim)
                     ->where('kode_mk', $kode_mk)
                     ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus dari list'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getListMK()
    {
        try {
            $mahasiswa = Auth::user()->mahasiswa;
            
            $listMK = ListMkMhs::where('nim', $mahasiswa->nim)
                              ->where('semester', $mahasiswa->semester_aktif)
                              ->with('mataKuliah')
                              ->get();

            return response()->json([
                'success' => true,
                'data' => $listMK
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil list mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }
}