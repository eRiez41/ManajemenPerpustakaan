<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'nama_lengkap',
        'nomor_identitas',
        'tipe_anggota',
        'email',
        'nomor_telepon',
        'alamat',
        'status_keanggotaan',
    ];
    
    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}