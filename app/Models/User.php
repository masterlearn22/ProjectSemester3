<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

     protected $table = 'users'; // Nama tabel
     protected $primaryKey = 'ID_USER';
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'no_hp',
        'wa',
        'pin',
        'ID_JENIS_USER'
    ];


    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'ID_JENIS_USER');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

    public function isAdmin()
    {
        return $this->JENIS_USER->JENIS_USER === 'admin';
    }

    public function isMahasiswa()
    {
        return $this->JENIS_USER->JENIS_USER === 'mahasiswa';
    }

    public function isUser()
    {
        return $this->JENIS_USER->JENIS_USER === 'user';
    }

//     public function isAnggota()
//     {
//         return $this->role === 'anggota';
//     }
}