<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk', 'nama', 'sks', 'semester', 'sifat', 'kode_prodi',
    ];

    public function pengampuanDosen()
    {
        return $this->belongsToMany(Dosen::class, 'pengampuan_dosen', 'kode_mk', 'nidn');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_mk', 'kode_mk');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kode_prodi');
    }
}