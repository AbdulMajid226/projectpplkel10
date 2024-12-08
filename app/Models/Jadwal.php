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

    const STATUS_PENDING = 'Menunggu Persetujuan';
    const STATUS_DISETUJUI = 'Sudah Disetujui';
    const STATUS_DITOLAK = 'Ditolak';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Menunggu Persetujuan',
            self::STATUS_DISETUJUI => 'Sudah Disetujui',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    public function getStatusColorClass()
    {
        return [
            self::STATUS_PENDING => 'bg-yellow-400 text-white',
            self::STATUS_DISETUJUI => 'bg-green-500 text-white',
            self::STATUS_DITOLAK => 'bg-red-500 text-white',
        ][$this->status] ?? 'bg-gray-100 text-gray-800';
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
        return $this->belongsTo(Waktu::class, 'waktu_id', 'id');
    }
}
