<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $table = 'irs';

    protected $fillable = [
        'nim',
        'semester',
        'thn_ajaran',
        'status_persetujuan',
        'tanggal_persetujuan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jadwal()
    {
        return $this->belongsToMany(Jadwal::class, 'pengambilan_irs', 'id_irs', 'id_jadwal');
    }

    public static function countbyStatus($status)
    {
        return self::where('status_persetujuan', $status)->count();
    }

    public static function getIRSByStatus($status)
    {
        if ($status == 'Belum Mengisi') {
            return self::with(['mahasiswa' => function($query) {
            $query->select('nim', 'nama', 'angkatan', 'status');
            }])
            ->where('status_persetujuan', $status)
            ->get();
        }
        return self::where('status_persetujuan', $status)->get();
    }

    public static function countIRSByNIM($nim)
    {
        return self::where('nim', $nim)->count();
    }

    public static function getIRSByNIM($nim)
    {
        return self::with(['jadwal' => function($query) {
            $query->select('jadwal.id as id_jadwal', 'jadwal.kode_mk', 'nama_mk', 'kelas', 'sks', 'semester')
                ->join('mata_kuliah', 'jadwal.kode_mk', '=', 'mata_kuliah.kode_mk');
        }])
        ->select('irs.id', 'nim', 'semester', 'thn_ajaran')
        ->where('nim', $nim)
        ->orderBy('semester', 'asc')
        ->get()
        ->map(function($irs) {
            return [
                'semester' => $irs->semester,
                'thn_ajaran' => $irs->thn_ajaran,
                'matakuliah' => $irs->jadwal->map(function($jadwal) use ($irs) {
                    return [
                        'kode_mk' => $jadwal->kode_mk,
                        'nama_mk' => MataKuliah::where('kode_mk', $jadwal->kode_mk)->value('nama'),
                        'kelas' => $jadwal->kelas,
                        'semester' => $jadwal->semester,
                        'status_pengambilan' => PengambilanIRS::where('id_irs', $irs->id)
                                                ->where('id_jadwal', $jadwal->id_jadwal)
                                                ->value('status_pengambilan'),
                        'sks' => $jadwal->sks
                    ];
                })
            ];
        });
    }
}