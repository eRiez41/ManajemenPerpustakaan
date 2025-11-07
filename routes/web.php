<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController; 
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    // 1. Hitung data
    $totalBuku = Buku::count();
    $totalKategori = Kategori::count();
    $totalRak = Rak::count();

    // 2. Kirim data ke view
    return view('dashboard', [
        'totalBuku' => $totalBuku,
        'totalKategori' => $totalKategori,
        'totalRak' => $totalRak,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kategori', KategoriController::class);
    Route::resource('rak', RakController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    // --- Rute untuk Laporan ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/buku', [LaporanController::class, 'laporanBuku'])->name('laporan.buku');
    Route::get('/laporan/anggota', [LaporanController::class, 'laporanAnggota'])->name('laporan.anggota');
    
    // Laporan Tambahan
    Route::get('/laporan/populer', [LaporanController::class, 'laporanPopuler'])->name('laporan.populer');
    Route::get('/laporan/aktif', [LaporanController::class, 'laporanAktif'])->name('laporan.aktif');
    Route::get('/laporan/denda', [LaporanController::class, 'laporanDenda'])->name('laporan.denda');
});

require __DIR__.'/auth.php';
