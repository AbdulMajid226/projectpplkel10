<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $table = 'kaprodi'; 
    protected $fillable = ['nama', 'user_id', 'kode_prodi'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kode_prodi', 'kode_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}