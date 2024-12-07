<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    use HasFactory;
    protected $table = 'waktu';
    protected $fillable = ['waktu_mulai', 'waktu_selesai'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}