<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    protected $table = 'JENIS_USER';
    protected $primaryKey = 'ID_JENIS_USER';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'ID_JENIS_USER', 'JENIS_USER'
    ];
    
    public function users()
    {
        return $this->hasMany(User::class, 'ID_JENIS_USER');
    }

    public function settings()
    {
        return $this->hasMany(SETTING_MENU_USER::class, 'ID_JENIS_USER');
    }
}

