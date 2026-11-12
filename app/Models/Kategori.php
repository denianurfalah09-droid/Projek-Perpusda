<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'icon',
        'deskripsi',
    ];

    /**
     * Relasi ke buku katalog berdasarkan nama kategori
     */
    public function buku()
    {
        return $this->hasMany(Katalog::class, 'kategori', 'nama_kategori');
    }
}
