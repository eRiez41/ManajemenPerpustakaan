<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController; 
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

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
});

require __DIR__.'/auth.php';
