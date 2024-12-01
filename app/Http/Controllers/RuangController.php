<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;

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

    public function getRoomCounts()
    {
        $approvedCount = Ruang::where('status', 'Sudah Disetujui')->count();
        $pendingCount = Ruang::where('status', 'Belum Disetujui')->count();
        $rejectedCount = Ruang::where('status', 'Ditolak')->count();

        return response()->json([
            'approved' => $approvedCount,
            'pending' => $pendingCount,
            'rejected' => $rejectedCount,
        ]);
    }
}