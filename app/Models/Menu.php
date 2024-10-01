<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Tabel yang digunakan
    protected $primaryKey = 'MENU_ID'; // Primary key

    public $timestamps = false; // Jika tabel tidak menggunakan created_at dan updated_at

    protected $fillable = [
        'MENU_ID',
        'MENU_NAME',
        'MENU_LINK',
        'MENU_ICON',
        'CREATE_BY',
        'DELETE_MARK',
        'UPDATE_BY',
        'CREATE_DATE',
        'UPDATE_DATE',
    ];
    
    // Relasi ke SettingMenuUser
    public function settings()
    {
        return $this->hasMany(SETTING_MENU_USER::class, 'MENU_ID', 'MENU_ID');
    }
}
