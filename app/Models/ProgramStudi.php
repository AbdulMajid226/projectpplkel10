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
        'kode_prodi', 'nama_prodi',
    ];
}