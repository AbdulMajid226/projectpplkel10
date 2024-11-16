<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'kode_mk', 'kode_ruang', 'kelas', 'kuota', 'thn_ajaran', 'hari', 'waktu',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'kode_ruang', 'kode_ruang');
    }

    public function irs()
    {
        return $this->belongsToMany(IRS::class, 'pengambilan_irs', 'id_jadwal', 'id_irs');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }
    public function kuota()
    {
        return $this->belongsTo(KuotaKelas::class, 'kuota', 'kuota');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'thn_ajaran', 'thn_ajaran');
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class, 'waktu_id', 'id');
    }
}