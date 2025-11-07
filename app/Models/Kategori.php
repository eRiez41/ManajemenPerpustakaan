<?php

namespace App\Models;

// --- INI YANG LENGKAP ---
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Relasi ke tabel Buku (satu kategori punya banyak buku).
     */
    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class);
    }
}
