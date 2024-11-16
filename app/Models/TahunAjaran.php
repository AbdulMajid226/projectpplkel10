<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'thn_ajaran';
    public $incrementing = false; // Karena primary key adalah string
    protected $keyType = 'string';

    protected $fillable = ['thn_ajaran'];
}