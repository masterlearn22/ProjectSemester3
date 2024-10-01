<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'message_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'message_id', 'sender', 'message_reference', 'subject', 
        'message_text', 'message_status', 'no_mk', 'create_by', 
        'create_date', 'delete_mark', 'update_by', 'recipient_email'
    ];
    
    
    public function category()
    {
        return $this->belongsTo(MessageCategory::class, 'no_mk');
    }
    
    public function documents()
    {
        return $this->hasMany(MessageDocument::class, 'message_id');
    }
    
    public function recipients()
    {
        return $this->hasMany(MessageTo::class, 'message_id');
    }
}

