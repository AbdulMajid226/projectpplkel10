<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IRS;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

            // Ambil jadwal yang sudah dipilih oleh mahasiswa di semester ini
            $jadwalDipilih = PengambilanIRS::whereHas('irs', function($query) use ($mahasiswa) {
                $query->where('nim', $mahasiswa->nim)
                      ->where('semester', $mahasiswa->semester_aktif);
            })->with('jadwal.waktu')->get();

            // Buat array untuk menyimpan kode_mk dan waktu jadwal yang sudah dipilih
            $mkDipilih = [];
            $jadwalWaktu = [];
            foreach ($jadwalDipilih as $jp) {
                $mkDipilih[$jp->jadwal->kode_mk] = $jp->id_jadwal;
                $jadwalWaktu[] = [
                    'hari' => $jp->jadwal->hari,
                    'mulai' => $jp->jadwal->waktu->waktu_mulai,
                    'selesai' => $jp->jadwal->waktu->waktu_selesai
                ];
            }

            // Kirim data jadwal dengan format yang benar dan informasi kuota
            $jadwalData = $jadwal->map(function($j) use ($kuotaTerisi, $jadwalDipilih, $mkDipilih, $jadwalWaktu) {
                $isSelected = in_array($j->id, $jadwalDipilih->pluck('id_jadwal')->toArray());
                $mkSudahDipilih = isset($mkDipilih[$j->kode_mk]);
                
                // Cek apakah jadwal ini bertabrakan dengan jadwal yang sudah dipilih
                $isBertabrakan = false;
                foreach ($jadwalWaktu as $jw) {
                    if ($j->hari === $jw['hari']) {
                        $jadwalMulai = strtotime($j->waktu->waktu_mulai);
                        $jadwalSelesai = strtotime($j->waktu->waktu_selesai);
                        $terpilihMulai = strtotime($jw['mulai']);
                        $terpilihSelesai = strtotime($jw['selesai']);

                        if (
                            ($jadwalMulai >= $terpilihMulai && $jadwalMulai < $terpilihSelesai) ||
                            ($jadwalSelesai > $terpilihMulai && $jadwalSelesai <= $terpilihSelesai) ||
                            ($jadwalMulai <= $terpilihMulai && $jadwalSelesai >= $terpilihSelesai)
                        ) {
                            $isBertabrakan = true;
                            break;
                        }
                    }
                }
                
                return [
                    'id' => (int)$j->id,
                    'kode_mk' => $j->kode_mk,
                    'nama_mk' => $j->mataKuliah->nama,
                    'semester' => $j->mataKuliah->semester,
                    'sks' => $j->mataKuliah->sks,
                    'hari' => $j->hari,
                    'waktu_mulai' => $j->waktu->waktu_mulai,
                    'waktu_selesai' => $j->waktu->waktu_selesai,
                    'kelas' => $j->kelas,
                    'ruang' => $j->ruang->kode_ruang,
                    'kuota' => $j->kuota,
                    'kuota_terisi' => $kuotaTerisi[$j->id] ?? 0,
                    'is_selected' => $isSelected,
                    'mk_selected' => $mkSudahDipilih,
                    'is_bertabrakan' => !$isSelected && $isBertabrakan,
                    'selected_jadwal_id' => $mkSudahDipilih ? $mkDipilih[$j->kode_mk] : null
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
    public function storePengambilanIRS(Request $request)
    {
        try {
            $mahasiswa = Auth::user()->mahasiswa;

            // Validasi jadwal
            $jadwal = Jadwal::with(['waktu', 'mataKuliah'])->findOrFail($request->jadwal_id);

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

            // Cek apakah sudah ada pengambilan untuk mata kuliah ini
            $existingPengambilan = PengambilanIRS::whereHas('jadwal', function($query) use ($jadwal) {
                $query->where('kode_mk', $jadwal->kode_mk);
            })->whereHas('irs', function($query) use ($mahasiswa) {
                $query->where('nim', $mahasiswa->nim)
                      ->where('semester', $mahasiswa->semester_aktif);
            })->first();

            if ($existingPengambilan) {
                throw new \Exception('Anda sudah mengambil mata kuliah ini');
            }

            // Cek kuota
            $kuotaTerisi = PengambilanIRS::where('id_jadwal', $jadwal->id)->count();
            if ($kuotaTerisi >= $jadwal->kuota) {
                throw new \Exception('Kuota kelas sudah penuh');
            }

            // Cek jadwal bentrok
            $jadwalBentrok = PengambilanIRS::whereHas('irs', function($query) use ($mahasiswa) {
                $query->where('nim', $mahasiswa->nim)
                      ->where('semester', $mahasiswa->semester_aktif);
            })->whereHas('jadwal.waktu', function($query) use ($jadwal) {
                $query->where('jadwal.hari', $jadwal->hari)
                      ->where(function($q) use ($jadwal) {
                          $q->whereBetween('waktu.waktu_mulai', [$jadwal->waktu->waktu_mulai, $jadwal->waktu->waktu_selesai])
                            ->orWhereBetween('waktu.waktu_selesai', [$jadwal->waktu->waktu_mulai, $jadwal->waktu->waktu_selesai])
                            ->orWhere(function($q) use ($jadwal) {
                                $q->where('waktu.waktu_mulai', '<=', $jadwal->waktu->waktu_mulai)
                                  ->where('waktu.waktu_selesai', '>=', $jadwal->waktu->waktu_selesai);
                            });
                      });
            })->exists();

            if ($jadwalBentrok) {
                throw new \Exception('Jadwal bentrok dengan mata kuliah lain');
            }

            // Simpan pengambilan jadwal
            $pengambilanIRS = PengambilanIRS::create([
                'id_irs' => $irs->id,
                'id_jadwal' => $request->jadwal_id,
                'status_pengambilan' => 'Baru'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dipilih',
                'data' => $pengambilanIRS
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
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
    
    public function deletePengambilanIRS($id)
    {
        try {
            // Cari pengambilan IRS berdasarkan id_jadwal
            $pengambilan = PengambilanIRS::where('id_jadwal', $id)
                ->whereHas('irs', function($query) {
                    $query->where('nim', Auth::user()->mahasiswa->nim);
                })
                ->firstOrFail();

            $pengambilan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus jadwal: ' . $e->getMessage()
            ], 500);
        }
    }
}