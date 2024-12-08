<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanIRS extends Model
{
    use HasFactory;

    protected $table = 'pengambilan_irs';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_irs',
        'id_jadwal',
        'status_pengambilan'
    ];

    // Tambahkan relasi ke model Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    // Tambahkan relasi ke model IRS
    public function irs()
    {
        return $this->belongsTo(IRS::class, 'id_irs');
    }
}