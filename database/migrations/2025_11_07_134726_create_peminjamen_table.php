<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            
            // Kolom relasi ke tabel anggotas
            $table->foreignId('anggota_id')->constrained('anggotas');
            
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_kembali_aktual')->nullable(); // Boleh kosong pas baru pinjam
            
            // Status transaksi: Dipinjam, Selesai, Telat
            $table->string('status')->default('Dipinjam'); 
            
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
