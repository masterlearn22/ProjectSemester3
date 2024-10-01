<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTo extends Model
{
    protected $primaryKey = 'no_record';
    public $incrementing = false;
    protected $fillable = ['no_record', 'message_id', 'to', 'cc', 'create_by', 'create_date', 'delete_mark', 'update_by'];
    
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}

