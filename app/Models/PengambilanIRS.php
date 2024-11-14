<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanIRS extends Model
{
    use HasFactory;

    protected $table = 'pengambilan_irs';

    public $timestamps = false;

    protected $fillable = [
        'id_irs',
        'id_jadwal',
    ];
}