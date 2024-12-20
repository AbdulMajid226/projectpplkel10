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
        $request->validate([
            'mata_kuliah' => 'required',
            'dosen' => 'required|array',
            'kelas' => 'required',
            'thn_ajaran' => 'required',
            'hari' => 'required',
            'waktu_id' => 'required',
            'ruang' => 'required',
        ]);

        $jadwal = Jadwal::create([
            'kode_mk' => $request->mata_kuliah,
            'kode_ruang' => $request->ruang,
            'kelas' => $request->kelas,
            'kuota' => 50,
            'thn_ajaran' => $request->thn_ajaran,
            'hari' => $request->hari,
            'waktu_id' => $request->waktu_id,
            'status' => Jadwal::STATUS_PENDING,
        ]);

        // Simpan relasi dosen-jadwal di tabel pengampuan_dosen
        foreach ($request->dosen as $nidn) {
            $jadwal->mataKuliah->pengampuanDosen()->attach($nidn);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil dibuat!');
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

    public function approveJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'Sudah Disetujui']);

            return redirect()->back()->with('success', 'Jadwal berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui jadwal: ' . $e->getMessage());
        }
    }

    public function rejectJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'Ditolak']);

            return redirect()->back()->with('success', 'Jadwal berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak jadwal: ' . $e->getMessage());
        }
    }

    public function cancelApprovalJadwal($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update(['status' => 'Menunggu Persetujuan']);

            return redirect()->back()->with('success', 'Persetujuan jadwal berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan persetujuan jadwal: ' . $e->getMessage());
        }
    }

    public function dashboardKaprodi()
    {        
        $jadwals = Jadwal::with('mataKuliah')->get();
        $countJadwals = [
            'ditolak' => Jadwal::where('status', Jadwal::STATUS_DITOLAK)->count(),
            'menunggu' => Jadwal::where('status', Jadwal::STATUS_PENDING)->count(),
            'disetujui' => Jadwal::where('status', Jadwal::STATUS_DISETUJUI)->count(),
        ];

        return view('kaprodi.dashboard', compact('jadwals', 'countJadwals'));
    }
}