<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruang';
    protected $primaryKey = 'kode_ruang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_ruang',
        'kode_prodi',
        'kuota',
        'status'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_ruang', 'kode_ruang');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kode_prodi', 'kode_prodi');
    }
}
