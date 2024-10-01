<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostingKomentar extends Model {
    protected $table = 'posting_komentar';
    protected $primaryKey = 'komen_id';
    public $timestamps = false;

    protected $fillable = [
        'komen_id',
        'posting_id',
        'id_user',
        'komentar_text',
        'komentar_gambar',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    // Relasi dengan posting
    public function posting() {
        return $this->belongsTo(Posting::class, 'posting_id', 'posting_id');
    }

    // App\Models\Posting.php
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'ID_USER'); // 'id_user' adalah foreign key di tabel posting_komentar
    }
}



