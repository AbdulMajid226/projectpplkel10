<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengampuanDosen extends Model
{
    use HasFactory;

    protected $table = 'pengampuan_dosen';

    public $timestamps = false;

    protected $fillable = [
        'nidn',
        'kode_mk',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk');
    }
}