<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'kode_mk',
        'kode_ruang',
        'kelas',
        'kuota',
        'hari',
        'jam_mulai',
        'jam_selesai',
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
}