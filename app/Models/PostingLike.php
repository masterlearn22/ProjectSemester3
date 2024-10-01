<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostingLike extends Model
{
    protected $table = 'posting_like';
    protected $primaryKey = 'like_id';
    public $timestamps = false;

    protected $fillable = [
        'like_id',
        'posting_id',
        'user_id',
        'create_by',
        'delete_mark',
        'update_by',
        'update_date',
    ];
}

