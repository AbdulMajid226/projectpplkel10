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
}
