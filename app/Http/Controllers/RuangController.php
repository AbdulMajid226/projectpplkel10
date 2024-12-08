<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\ProgramStudi;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class RuangController extends Controller
{
    /**
     * Retrieve rooms based on their status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomsByStatus(Request $request)
    {
        $status = $request->query('status');
        $rooms = Ruang::where('status', $status)->get();

        return response()->json($rooms);
    }

    public function updateRoom(Request $request, $kodeRuang)
    {
        $room = Ruang::findOrFail($kodeRuang);
        $room->update([
            'kuota' => $request->input('kuota'),
            'status' => 'Belum Disetujui', // Reset status to pending approval
        ]);

        return response()->json(['message' => 'Ruang berhasil diperbarui dan menunggu persetujuan.']);
    }

    public function deleteRoom($kodeRuang)
    {
        $room = Ruang::findOrFail($kodeRuang);
        $room->delete();

        return response()->json(['message' => 'Ruang berhasil dihapus.']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_ruang' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        $programStudi = ProgramStudi::where('kode_prodi', $request->input('program_studi'))->firstOrFail();

        Ruang::create([
            'kode_ruang' => $request->input('kode_ruang'),
            'kode_prodi' => $programStudi->kode_prodi,
            'kode_fakultas' => $programStudi->kode_fakultas,
            'kuota' => $request->input('kuota'),
            'status' => 'BelumDisetujui',
        ]);

        return redirect()->back()->with('success', 'Pengajuan ruang berhasil diajukan.');
    }

    public function index()
    {
        $bagianAkademik = auth('web')->user()->bagianAkademik;
        $getProgramStudis = $bagianAkademik->getProgramStudi; // Mengambil data program studi berdasarkan fakultas dari bagian akademik
        $ruangs = Ruang::where('kode_fakultas', $bagianAkademik->kode_fakultas)->get();
        return view('bagian_akademik.ajukan_ruang', compact('ruangs', 'getProgramStudis'));
    }

    public function dashboard()
    {

        $bagianAkademik = auth('web')->user()->bagianAkademik;
        $getProgramStudis = $bagianAkademik->getProgramStudi;
        $ruangs = Ruang::where('kode_fakultas', $bagianAkademik->kode_fakultas)->get();
        $approvedCount = $ruangs->where('status', 'disetujui')->count();
        $pendingCount = $ruangs->where('status', 'BelumDisetujui')->count();
        $rejectedCount = $ruangs->where('status', 'ditolak')->count();

        return view('bagian_akademik.dashboard', compact('approvedCount', 'pendingCount', 'rejectedCount', 'ruangs','getProgramStudis'));
    }

    public function destroy($kodeRuang)
    {
        $ruang = Ruang::findOrFail($kodeRuang);
        $ruang->delete();

        return redirect()->back()->with('success', 'Pengajuan ruang berhasil dihapus');
    }

    public function edit($kodeRuang)
    {
        $ruang = Ruang::with('programStudi')->findOrFail($kodeRuang);

        $bagianAkademik = auth('web')->user()->bagianAkademik;
        $programStudis = $bagianAkademik->getProgramStudi;

        return response()->json([
            'ruang' => $ruang,
            'programStudis' => $programStudis
        ]);
    }

    public function update(Request $request, $kodeRuang)
    {
        try {
            $request->validate([
                'kode_ruang' => 'required|string|max:255|unique:ruang,kode_ruang,'.$kodeRuang.',kode_ruang',
                'program_studi' => 'required|exists:program_studi,kode_prodi',
                'kuota' => 'required|integer|min:1',
            ]);

            $programStudi = ProgramStudi::where('kode_prodi', $request->input('program_studi'))->firstOrFail();

            $ruang = Ruang::findOrFail($kodeRuang);

            $updated = $ruang->update([
                'kode_ruang' => $request->kode_ruang,
                'kode_prodi' => $programStudi->kode_prodi,
                'kode_fakultas' => $programStudi->kode_fakultas,
                'kuota' => $request->kuota,
                'status' => 'BelumDisetujui'
            ]);

            if($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ruang berhasil diperbarui'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui ruang'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function countRuangByStatus($status)
    {
        return Ruang::where('status', $status)->count();
    }

    public function pengesahanRuang()
    {
        $ruangs = Ruang::with('programStudi')->get();
        $counts = [
            'ditolak' => $this->countRuangByStatus('ditolak'),
            'menunggu' => $this->countRuangByStatus('BelumDisetujui'),
            'disetujui' => $this->countRuangByStatus('disetujui'),
        ];

        return view('dekan.pengesahan_ruang', compact('ruangs', 'counts'));
    }

    public function pengesahanJadwal()
    {
        $jadwals = Jadwal::with('mataKuliah')->get();
        $counts = [
            'ditolak' => Jadwal::where('status', Jadwal::STATUS_DITOLAK)->count(),
            'menunggu' => Jadwal::where('status', Jadwal::STATUS_PENDING)->count(),
            'disetujui' => Jadwal::where('status', Jadwal::STATUS_DISETUJUI)->count(),
        ];

        return view('dekan.pengesahan_jadwal', compact('jadwals', 'counts'));
    }

    public function dashboardDekan()
    {
        $ruangs = Ruang::with('programStudi')->get();
        $countRuangs = [
            'ditolak' => $this->countRuangByStatus('ditolak'),
            'menunggu' => $this->countRuangByStatus('BelumDisetujui'), 
            'disetujui' => $this->countRuangByStatus('disetujui'),
        ];
        
        $jadwals = Jadwal::with('mataKuliah')->get();
        $countJadwals = [
            'ditolak' => Jadwal::where('status', Jadwal::STATUS_DITOLAK)->count(),
            'menunggu' => Jadwal::where('status', Jadwal::STATUS_PENDING)->count(),
            'disetujui' => Jadwal::where('status', Jadwal::STATUS_DISETUJUI)->count(),
        ];

        return view('dekan.dashboard', compact('ruangs', 'countRuangs', 'jadwals', 'countJadwals'));
    }

    public function getStatusColorClass($status)
    {
        return [
            'BelumDisetujui' => 'bg-yellow-400 text-white',
            'disetujui' => 'bg-green-500 text-white', 
            'ditolak' => 'bg-red-500 text-white',
        ][$status] ?? 'bg-gray-100 text-gray-800';
    }
}