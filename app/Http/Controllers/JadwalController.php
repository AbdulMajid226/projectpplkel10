<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Jadwal;
use App\Models\Waktu;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::with('pengampuanDosen')->get();
        $dosens = Dosen::all();
        $ruangs = Ruang::all();
        $waktus = Waktu::all();
        $jadwals = Jadwal::with([
            'mataKuliah.pengampuanDosen',
            'ruang',
            'waktu'
        ])->get();
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::all();

        return view('kaprodi.buat_jadwal', compact(
            'mataKuliahs',
            'dosens',
            'ruangs',
            'waktus',
            'jadwals',
            'kelas',
            'tahunAjaran'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah' => 'required|exists:mata_kuliah,kode_mk',
            'dosen' => 'required|array|min:1',
            'dosen.*' => 'exists:dosen,nidn',
            'kelas' => 'required',
            'thn_ajaran' => 'required',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'waktu_id' => 'required|exists:waktu,id',
            'ruang' => 'required|exists:ruang,kode_ruang',
        ]);

        // Check for conflicts
        $jadwal = new Jadwal();
        
        // Check room conflict
        if ($jadwal->hasConflict($request->hari, $request->waktu_id, $request->ruang)) {
            return back()
                ->withInput()
                ->withErrors(['conflict' => 'Ruangan sudah digunakan pada waktu tersebut.']);
        }

        // Check dosen conflict
        if ($jadwal->hasDosenConflict($request->hari, $request->waktu_id, $request->dosen)) {
            return back()
                ->withInput()
                ->withErrors(['conflict' => 'Dosen sudah memiliki jadwal pada waktu tersebut.']);
        }

        // Check kelas conflict
        if ($jadwal->hasKelasConflict($request->hari, $request->waktu_id, $request->kelas)) {
            return back()
                ->withInput()
                ->withErrors(['conflict' => 'Kelas sudah memiliki jadwal pada waktu tersebut.']);
        }

        try {
            DB::transaction(function () use ($request) {
                $jadwal = Jadwal::create([
                    'mata_kuliah_id' => $request->mata_kuliah,
                    'kelas' => $request->kelas,
                    'thn_ajaran' => $request->thn_ajaran,
                    'hari' => $request->hari,
                    'waktu_id' => $request->waktu_id,
                    'ruang' => $request->ruang,
                    'status' => 'pending'
                ]);

                // Attach dosen to mata kuliah if not already attached
                $mataKuliah = MataKuliah::find($request->mata_kuliah);
                $mataKuliah->pengampuanDosen()->syncWithoutDetaching($request->dosen);
            });

            return redirect()->route('jadwal.index')
                ->with('success', 'Jadwal berhasil dibuat dan menunggu persetujuan.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan jadwal.']);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_kuliah' => 'required',
            'dosen' => 'required|array',
            'kelas' => 'required',
            'thn_ajaran' => 'required',
            'hari' => 'required',
            'waktu_id' => 'required',
            'ruang' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        
        // Update jadwal
        $jadwal->update([
            'kode_mk' => $request->mata_kuliah,
            'kode_ruang' => $request->ruang,
            'kelas' => $request->kelas,
            'thn_ajaran' => $request->thn_ajaran,
            'hari' => $request->hari,
            'waktu_id' => $request->waktu_id,
            'updated_at' => now() // Explicitly set updated_at
        ]);

        // Update dosen relationships
        $jadwal->mataKuliah->pengampuanDosen()->sync($request->dosen);

        return redirect()->route('buatjadwalkuliah')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        // Hapus relasi dosen terlebih dahulu
        $jadwal->mataKuliah->pengampuanDosen()->detach();

        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::with(['mataKuliah', 'ruang', 'waktu'])->findOrFail($id);
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangs = Ruang::all();
        $waktus = Waktu::all();
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::all();

        return view('kaprodi.edit_jadwal', compact(
            'jadwal', 
            'mataKuliahs', 
            'dosens', 
            'ruangs', 
            'waktus', 
            'kelas', 
            'tahunAjaran'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status jadwal berhasil diperbarui!');
    }

    public function getMataKuliah($kodeMK)
    {
        $mataKuliah = MataKuliah::findOrFail($kodeMK);
        return response()->json([
            'kode_mk' => $mataKuliah->kode_mk,
            'nama' => $mataKuliah->nama,
            'sks' => $mataKuliah->sks
        ]);
    }

    public function approveJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'disetujui']);

            return redirect()->back()->with('success', 'Jadwal berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui jadwal: ' . $e->getMessage());
        }
    }

    public function rejectJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'ditolak']);

            return redirect()->back()->with('success', 'Jadwal berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak jadwal: ' . $e->getMessage());
        }
    }

    public function cancelApprovalJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'BelumDisetujui']);

            return redirect()->back()->with('success', 'Persetujuan jadwal berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan persetujuan jadwal: ' . $e->getMessage());
        }
    }
}