<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primarykey  = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'nim','nama' ,'angkatan','prodi','nidn','user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function pembimbingAkademik() {
        return $this->belongsTo(PembimbingAkademik::class, 'nidn', 'nidn');
    }
    public function irs(){
        return  $this->hasMany(IRS::class, 'nim', 'nim');
    }  
}