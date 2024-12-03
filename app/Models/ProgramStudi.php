<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $primaryKey = 'kode_prodi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_prodi', 'nama_prodi', 'kode_fakultas',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function ruangan()
    {
        return $this->hasMany(Ruang::class, 'kode_prodi', 'kode_prodi');
    }
}
