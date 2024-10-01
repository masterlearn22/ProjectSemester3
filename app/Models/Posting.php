<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $table = 'posting';
    protected $primaryKey = 'posting_id';
    public $timestamps = false;
    protected $casts = [
        'posting_id' => 'string', // Misal, jika `posting_id` adalah UUID atau string
    ];
    

    protected $fillable = [
        'posting_id',
        'sender',
        'message_text',
        'message_gambar',
        'create_by',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    // Relasi dengan komentar
    public function komentar() {
        return $this->hasMany(PostingKomentar::class, 'posting_id', 'posting_id')
                    ->where('delete_mark', '0');
    }

    // App\Models\Posting.php
    public function user()
{
    return $this->belongsTo(User::class, 'sender', 'ID_USER'); // 'sender' adalah foreign key di tabel posting
}

}


