<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\ProgramStudi;

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

        Ruang::create([
            'kode_ruang' => $request->input('kode_ruang'),
            'kode_prodi' => $request->input('program_studi'),
            'kuota' => $request->input('kuota'),
            'status' => 'BelumDisetujui',
        ]);

        return redirect()->back()->with('success', 'Pengajuan ruang berhasil diajukan.');
    }

    public function index()
    {
        $ruangs = Ruang::all(); // Mengambil semua data ruang
        return view('bagian_akademik.ajukan_ruang', compact('ruangs'));
    }

    public function dashboard()
    {
        $approvedCount = Ruang::where('status', 'disetujui')->count();
        $pendingCount = Ruang::where('status', 'BelumDisetujui')->count();
        $rejectedCount = Ruang::where('status', 'ditolak')->count();
        $ruangs = Ruang::with('programStudi')->get();

        return view('bagian_akademik.dashboard', compact('approvedCount', 'pendingCount', 'rejectedCount', 'ruangs'));
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
        $programStudis = ProgramStudi::all();

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

            $ruang = Ruang::findOrFail($kodeRuang);

            $updated = $ruang->update([
                'kode_ruang' => $request->kode_ruang,
                'kode_prodi' => $request->program_studi,
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
}
