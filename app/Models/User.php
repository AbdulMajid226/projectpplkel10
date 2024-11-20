<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasiswa(){
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id');
    }

    public function pembimbingAkademik()
    {
        return $this->hasOne(PembimbingAkademik::class);
    }

    public function bagianAkademik()
    {
        return $this->hasOne(BagianAkademik::class, 'user_id', 'id');
    }

    public function dekan()
    {
        return $this->hasOne(Dekan::class, 'user_id', 'id');
    }

    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'user_id', 'id');
    }
    
}