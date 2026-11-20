<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;

    protected $table = 'katalogs';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'gambar',
    ];

    /**
     * URL untuk cover buku (mendukung storage/public maupun legacy uploads/katalog)
     */
    public function getCoverUrlAttribute(): ?string
    {
        if (empty($this->gambar)) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        // 1. Cek di disk storage public (misal: katalog/xxx.jpg)
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }

        if (file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }

        // 2. Cek di storage dengan prefix katalog/ jika di DB tersimpan tanpa prefix
        if (!\Illuminate\Support\Str::startsWith($this->gambar, 'katalog/')) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists('katalog/' . $this->gambar)) {
                return asset('storage/katalog/' . $this->gambar);
            }
            if (file_exists(public_path('storage/katalog/' . $this->gambar))) {
                return asset('storage/katalog/' . $this->gambar);
            }
        }

        // 3. Cek di folder lama uploads/katalog/
        if (file_exists(public_path('uploads/katalog/' . $this->gambar))) {
            return asset('uploads/katalog/' . $this->gambar);
        }

        $rawBasename = basename($this->gambar);
        if (file_exists(public_path('uploads/katalog/' . $rawBasename))) {
            return asset('uploads/katalog/' . $rawBasename);
        }

        // Jika path berupa 'katalog/xxx.jpg', kembalikan URL storage publik
        if (\Illuminate\Support\Str::startsWith($this->gambar, 'katalog/')) {
            return asset('storage/' . $this->gambar);
        }

        return null;
    }
}
