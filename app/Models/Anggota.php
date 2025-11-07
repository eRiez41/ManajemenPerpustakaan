<?php

namespace App\Models; // <-- INI YANG SUDAH BENAR

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}