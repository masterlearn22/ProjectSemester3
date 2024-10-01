<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDocument extends Model
{
    protected $primaryKey = 'no_mdok';
    public $incrementing = false;
    protected $fillable = ['no_mdok', 'file', 'description', 'message_id', 'create_by', 'create_date', 'delete_mark', 'update_by'];
    
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
