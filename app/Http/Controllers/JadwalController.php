<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Jadwal;
use App\Models\Waktu;

class JadwalController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangs = Ruang::all();
        $waktus = Waktu::all();
        $jadwals = Jadwal::with(['mataKuliah', 'ruang', 'waktu'])->get();

        return view('kaprodi.buat_jadwal', compact('mataKuliahs', 'dosens', 'ruangs', 'waktus', 'jadwals'));
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
        $jadwal->update([
            'kode_mk' => $request->mata_kuliah,
            'kode_ruang' => $request->ruang,
            'kelas' => $request->kelas,
            'thn_ajaran' => $request->thn_ajaran,
            'hari' => $request->hari,
            'waktu_id' => $request->waktu_id,
        ]);

        // Update relasi dosen
        $jadwal->mataKuliah->pengampuanDosen()->sync($request->dosen);

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        // Hapus relasi dosen terlebih dahulu
        $jadwal->mataKuliah->pengampuanDosen()->detach();

        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}