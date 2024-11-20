<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    protected $table = 'fakultas';
    protected $primaryKey = 'kode_fakultas';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_fakultas', 'nama',
    ];


    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function dekan()
    {
        return $this->hasOne(Dekan::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function bagianAkademik()
    {
        return $this->hasMany(BagianAkademik::class, 'kode_fakultas', 'kode_fakultas');
    }
}