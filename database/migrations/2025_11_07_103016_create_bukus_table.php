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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('tahun_terbit');
            $table->string('isbn')->nullable()->unique(); // Opsional tapi unik
            $table->integer('jumlah_stok')->default(0);
            $table->integer('harga_buku')->default(0);
            $table->string('cover')->nullable(); // Opsional
            $table->text('deskripsi')->nullable(); // Opsional

            // --- INI RELASINYA ---
            // "kategori_id" nyambung ke "id" di tabel "kategoris"
            $table->foreignId('kategori_id')->constrained('kategoris');

            // "rak_id" nyambung ke "id" di tabel "raks"
            $table->foreignId('rak_id')->constrained('raks');
            // ---------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
