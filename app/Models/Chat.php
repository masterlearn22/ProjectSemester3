<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {
    protected $fillable = ['message', 'ID_USER'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_USER', 'ID_USER');
    }
}
