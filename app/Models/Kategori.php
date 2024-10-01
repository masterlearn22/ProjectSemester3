<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['jenis_kategori'];

    // Relasi One-to-Many dengan KoleksiBuku
    public function koleksiBukus()
    {
        return $this->hasMany(KoleksiBuku::class, 'id_kategori', 'id_kategori');
    }
}