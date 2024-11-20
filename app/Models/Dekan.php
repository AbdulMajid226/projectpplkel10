<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    use HasFactory;
    
    protected $table = 'dekan'; // Nama tabel
    protected $fillable = ['nama', 'user_id', 'kode_fakultas'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}