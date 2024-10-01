<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageCategory extends Model
{
    protected $primaryKey = 'no_mk';
    public $incrementing = false;
    protected $fillable = ['no_mk', 'description', 'create_by', 'create_date', 'delete_mark', 'update_by'];
    
    public function messages()
    {
        return $this->hasMany(Message::class, 'no_mk');
    }
}

