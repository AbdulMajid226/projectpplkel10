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

    public function pengambilanIrs()
    {
        return $this->hasMany(PengambilanIRS::class, 'id_irs');
    }

    public static function countIRSByNIM($nim)
    {
        return self::where('nim', $nim)->count();
    }

    public static function getIRSByNIM($nim)
    {
        return self::with(['jadwal' => function($query) {
            $query->with(['dosen', 'ruang', 'waktu'])
                ->select(
                    'jadwal.id as id_jadwal',
                    'jadwal.kode_mk',
                    'jadwal.kelas',
                    'jadwal.kode_ruang',
                    'jadwal.hari',
                    'jadwal.waktu_id',
                    'mata_kuliah.nama as nama_mk',
                    'mata_kuliah.sks',
                    'mata_kuliah.semester'
                )
                ->join('mata_kuliah', 'jadwal.kode_mk', '=', 'mata_kuliah.kode_mk');
        }])
        ->select('irs.id', 'nim', 'semester', 'thn_ajaran', 'status_persetujuan')
        ->where('nim', $nim)
        ->orderBy('semester', 'asc')
        ->get()
        ->map(function($irs) {
            return [
                'semester' => $irs->semester,
                'thn_ajaran' => $irs->thn_ajaran,
                'status_persetujuan' => $irs->status_persetujuan,
                'matakuliah' => $irs->jadwal->map(function($jadwal) use ($irs) {
                    $dosen = Dosen::whereHas('pengampuanDosen', function($query) use ($jadwal) {
                        $query->where('pengampuan_dosen.kode_mk', '=', $jadwal->kode_mk);
                    })->pluck('nama')->join(', ');

                    return [
                        'kode_mk' => $jadwal->kode_mk,
                        'nama_mk' => $jadwal->nama_mk,
                        'kelas' => $jadwal->kelas,
                        'semester' => $jadwal->semester,
                        'status_pengambilan' => PengambilanIRS::where('id_irs', $irs->id)
                                                ->where('id_jadwal', $jadwal->id_jadwal)
                                                ->value('status_pengambilan'),
                        'sks' => $jadwal->sks,
                        'ruang' => $jadwal->kode_ruang,
                        'nama_dosen' => $dosen,
                        'waktu' => $jadwal->hari . ' pukul ' .
                                  substr($jadwal->waktu->waktu_mulai, 0, 5) . ' - ' .
                                  substr($jadwal->waktu->waktu_selesai, 0, 5),
                    ];
                })
            ];
        });
    }
}
