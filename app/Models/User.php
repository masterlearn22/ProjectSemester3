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
        'profile_photo',
        'no_hp',
        'wa',
        'pin',
        'ID_JENIS_USER',
    ];
        


    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'ID_JENIS_USER');
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function postings()
    {
        return $this->hasMany(Posting::class, 'sender', 'ID_USER');
    }
}