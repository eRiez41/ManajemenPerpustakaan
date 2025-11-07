<?php

namespace App\Models;

// --- INI YANG LENGKAP ---
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rak extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'kode_rak',
        'lokasi',
    ];

    /**
     * Relasi ke tabel Buku (satu rak punya banyak buku).
     */
    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class);
    }
}