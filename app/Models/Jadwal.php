<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kode_mk', 'kode_ruang', 'kelas', 'kuota', 'thn_ajaran', 'hari', 'status', 'waktu_id',
    ];

    protected $with = ['waktu'];

    const STATUS_MENUNGGU = 'Menunggu Persetujuan';
    const STATUS_DISETUJUI = 'Sudah Disetujui';
    const STATUS_DITOLAK = 'Ditolak';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_MENUNGGU,
            self::STATUS_DISETUJUI,
            self::STATUS_DITOLAK,
        ];
    }

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
        return $this->belongsTo(Waktu::class, 'waktu_id');
    }
}