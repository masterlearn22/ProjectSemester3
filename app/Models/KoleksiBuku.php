<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiBuku extends Model
{
    use HasFactory;

    protected $table = 'koleksi_bukus';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['id_kategori', 'kode', 'judul', 'pengarang'];

    // Relasi Many-to-One dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
