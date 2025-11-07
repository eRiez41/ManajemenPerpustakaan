<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman; // <-- TAMBAH INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- TAMBAH INI

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman "Hub" Laporan
     */
    public function index()
    {
        return view('laporan.index');
    }

    /**
     * Menampilkan Laporan Buku (dengan filter)
     */
    public function laporanBuku(Request $request)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $query = Buku::query()->with(['kategori', 'rak']);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $bukus = $query->orderBy('judul')->get();

        return view('laporan.buku', [
            'bukus' => $bukus,
            'kategoris' => $kategoris,
            'selectedKategori' => $request->kategori_id,
        ]);
    }

    /**
     * Menampilkan Laporan Anggota
     */
    public function laporanAnggota()
    {
        $anggotas = Anggota::orderBy('nama_lengkap')->get();
        
        return view('laporan.anggota', compact('anggotas'));
    }

    // --- 👇 FUNGSI BARU DIMULAI DARI SINI 👇 ---

    /**
     * Laporan Buku Terpopuler
     */
    public function laporanPopuler()
    {
        // 'withCount' akan menghitung 'peminjamans' (dari relasi yg kita buat)
        // dan menyimpannya di 'peminjamans_count'
        $bukus = Buku::withCount('peminjamans')
                     ->orderBy('peminjamans_count', 'desc') // Urutkan dari yg terbanyak
                     ->take(20) // Ambil 20 teratas
                     ->get();

        return view('laporan.populer', compact('bukus'));
    }

    /**
     * Laporan Anggota Teraktif
     */
    public function laporanAktif()
    {
        $anggotas = Anggota::withCount('peminjamans')
                           ->orderBy('peminjamans_count', 'desc')
                           ->take(20)
                           ->get();
        
        return view('laporan.aktif', compact('anggotas'));
    }

    /**
     * Laporan Pemasukan Denda
     */
    public function laporanDenda()
    {
        // Ambil semua transaksi yg ada dendanya
        $transaksiDenda = Peminjaman::where('total_denda', '>', 0)
                                    ->with('anggota')
                                    ->latest()
                                    ->get();
        
        // Hitung total semua denda
        $totalDenda = $transaksiDenda->sum('total_denda');

        return view('laporan.denda', compact('transaksiDenda', 'totalDenda'));
    }

    public function laporanTelat()
    {
        // Ambil data peminjaman yang:
        // 1. Statusnya masih "Dipinjam"
        // 2. Tanggal jatuh temponya SUDAH LEWAT dari hari ini
        $peminjamanTelat = Peminjaman::where('status', 'Dipinjam')
                                     ->where('tanggal_jatuh_tempo', '<', now()->toDateString())
                                     ->with(['anggota', 'bukus'])
                                     ->orderBy('tanggal_jatuh_tempo', 'asc') // Urutkan dari yg paling lama telat
                                     ->get();

        return view('laporan.telat', compact('peminjamanTelat'));
    }
}