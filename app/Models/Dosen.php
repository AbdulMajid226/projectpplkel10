<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nidn',
        'gelar',
        'prodi',
    ];

    public function pengampuanDosen()
    {
        return $this->belongsToMany(MataKuliah::class, 'pengampuan_dosen', 'nidn', 'kode_mk');
    }
}