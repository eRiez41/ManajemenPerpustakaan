<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buku extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'jumlah_stok',
        'harga_buku',
        'cover',
        'deskripsi',
        'kategori_id', // <-- Foreign key
        'rak_id',      // <-- Foreign key
    ];

    /**
     * Relasi ke tabel Kategori (satu buku punya satu kategori).
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke tabel Rak (satu buku punya satu rak).
     */
    public function rak(): BelongsTo
    {
        return $this->belongsTo(Rak::class);
    }

    public function peminjamans(): BelongsToMany
    {
        return $this->belongsToMany(Peminjaman::class, 'buku_peminjaman');
    }
}
