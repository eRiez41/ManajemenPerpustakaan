<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            
            // Ini pengganti 'email' / 'telepon' sebagai data unik
            $table->string('nomor_identitas')->unique(); // Buat NIM / NIDN
            
            // Kita pake enum (pilihan) biar jelas statusnya
            $table->enum('tipe_anggota', ['Mahasiswa', 'Dosen', 'Staff']); 
            
            $table->string('email')->unique()->nullable(); // Email kampus (opsional)
            $table->string('nomor_telepon')->nullable(); // No HP (opsional)
            $table->text('alamat')->nullable();
            
            // Status keanggotaan (Aktif / Nonaktif / Diblokir)
            $table->string('status_keanggotaan')->default('Aktif'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
