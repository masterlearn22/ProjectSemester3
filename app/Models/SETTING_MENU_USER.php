<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SETTING_MENU_USER extends Model
{
    use HasFactory;

    protected $table = 'SETTING_MENU_USER';
    protected $primaryKey = 'NO_SETTING';

    public $timestamps = false;
    protected $fillable = [
        'NO_SETTING',
        'ID_JENIS_USER',
        'MENU_ID',
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK',
        'UPDATE_BY',
        'UPDATE_DATE',
    ];
    
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'ID_JENIS_USER');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MENU_ID');
    }
}
