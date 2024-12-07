<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianAkademik extends Model
{
    use HasFactory;

    protected $table = 'bagian_akademik';
    protected $fillable = ['nama', 'user_id', 'kode_fakultas'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getProgramStudi(){
        return $this->hasMany(ProgramStudi::class, 'kode_fakultas', 'kode_fakultas');
    }

}
