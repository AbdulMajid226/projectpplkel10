<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'kode_prodi',
        'nidn',
        'user_id',
        'status',
        'semester_aktif'
    ];

    protected $casts = [
        'semester_aktif' => 'integer',
    ];

    protected $with = ['pembimbingAkademik'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pembimbingAkademik() {
        return $this->belongsTo(PembimbingAkademik::class, 'nidn', 'nidn');
    }

    public function irs(){
        return $this->hasMany(IRS::class, 'nim', 'nim');
    }

    public function getTahunAjaranAktifAttribute()
    {
        $tahunAjaran = TahunAjaran::orderBy('thn_ajaran', 'desc')->first();
        return $tahunAjaran ? $tahunAjaran->thn_ajaran : '';
    }

    public function getStatusAkademikAttribute()
    {
        return [
            'status' => $this->status,
            'semester_aktif' => $this->semester_aktif,
            'tahun_ajaran' => $this->tahun_ajaran_aktif,
            'dosen_wali' => $this->pembimbingAkademik ? $this->pembimbingAkademik->nama : null,
            'nidn_dosen_wali' => $this->nidn
        ];
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kode_prodi', 'kode_prodi');
    }
}