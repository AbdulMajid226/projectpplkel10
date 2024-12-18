<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\IRS;

class mahasiswaController extends Controller
{
    public function setStatusAktif(Request $request)
    {
        $mahasiswa = auth('web')->user()->mahasiswa;

        if ($mahasiswa->status === 'Belum Registrasi') {
            $mahasiswa->status = 'Aktif';
            $mahasiswa->save();

            return redirect()->route('dashboard_mhs')
                ->with('success', 'Status berhasil diubah menjadi Aktif. Silakan isi IRS Anda.');
        }

        return redirect()->back()
            ->with('error', 'Anda tidak dapat mengubah status karena sudah teregistrasi.');
    }

    public function setStatusCuti(Request $request)
    {
        $mahasiswa = auth('web')->user()->mahasiswa;

        if ($mahasiswa->status === 'Belum Registrasi') {
            $mahasiswa->status = 'Cuti';
            $mahasiswa->save();

            return redirect()->route('dashboard_mhs')
                ->with('success', 'Status berhasil diubah menjadi Cuti.');
        }

        return redirect()->back()
            ->with('error', 'Anda tidak dapat mengubah status karena sudah teregistrasi.');
    }

    public function searchMahasiswa(Request $request)
    {
        try {
            $query = Mahasiswa::query();

            // Filter berdasarkan prodi
            if ($request->has('prodi')) {
                $query->where('kode_prodi', $request->prodi);
            }

            // Filter berdasarkan angkatan
            if ($request->has('angkatan')) {
                $query->where('angkatan', $request->angkatan);
            }

            // Filter berdasarkan nama/nim
            if ($request->has('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('nama', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nim', 'LIKE', "%{$searchTerm}%");
                });
            }

            $mahasiswa = $query->with(['programStudi'])->get();

            // Ambil data IRS untuk setiap mahasiswa
            $mahasiswaData = $mahasiswa->map(function($mhs) {
                $irsData = IRS::getIRSByNIM($mhs->nim);
                return [
                    'mahasiswa' => $mhs,
                    'irs_data' => $irsData
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $mahasiswaData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari data mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }
}
