<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali_aktual',
        'status',
    ];

    /**
     * Relasi ke Anggota (Satu Peminjaman dimiliki 1 Anggota)
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Relasi ke Buku (Satu Peminjaman bisa punya Banyak Buku)
     * 'buku_peminjaman' adalah nama tabel pivot/penghubungnya
     */
    public function bukus(): BelongsToMany
    {
        return $this->belongsToMany(Buku::class, 'buku_peminjaman');
    }
}