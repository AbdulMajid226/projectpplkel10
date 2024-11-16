<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuotaKelas extends Model
{
    use HasFactory;

    
    protected $table = 'kuota_kelas'; 
    protected $primaryKey = 'kuota'; 
    public $incrementing = false; 
    protected $keyType = 'int'; 

    protected $fillable = ['kuota']; 
}