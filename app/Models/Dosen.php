<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nidn', 'nama', 'kode_prodi',
    ];

    public function pengampuanDosen()
    {
        return $this->belongsToMany(MataKuliah::class, 'pengampuan_dosen', 'nidn', 'kode_mk');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kode_prodi');
    }
}