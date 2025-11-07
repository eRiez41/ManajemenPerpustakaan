<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Support\Facades\DB; // <-- Tambahin ini
use Carbon\Carbon; // <-- Tambahin ini

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data peminjaman, 'with()' untuk ambil relasinya (biar efisien)
        $peminjamans = Peminjaman::with(['anggota', 'bukus'])->latest()->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // 1. Ambil semua anggota yang statusnya "Aktif"
    $anggotas = Anggota::where('status_keanggotaan', 'Aktif')
                        ->orderBy('nama_lengkap')
                        ->get();

    // 2. Ambil semua buku yang stoknya LEBIH DARI 0
    $bukus = Buku::where('jumlah_stok', '>', 0)
                 ->orderBy('judul')
                 ->get();

    // 3. Tampilkan view dan kirim datanya
    return view('peminjaman.create', compact('anggotas', 'bukus'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data form
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
            'buku_ids' => 'required|array|min:1', // Pastikan minimal 1 buku dipilih
            'buku_ids.*' => 'required|exists:bukus,id', // Pastikan semua ID buku ada di tabel
        ]);

        // 2. Mulai "Database Transaction" (Biar aman)
        try {
            DB::beginTransaction();

            // 3. Cek Stok Dulu Sebelum Lanjut
            $bukus = Buku::find($validated['buku_ids']);
            foreach ($bukus as $buku) {
                if ($buku->jumlah_stok < 1) {
                    // Kalo ada buku yg stoknya 0, GAGALKAN SEMUA
                    throw new \Exception("Buku '{$buku->judul}' sedang kosong (stok 0).");
                }
            }

            // 4. Buat "Struk" Peminjaman
            $peminjaman = Peminjaman::create([
                'anggota_id' => $validated['anggota_id'],
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
                'status' => 'Dipinjam',
            ]);

            // 5. Nyantolin buku-buku ke "Struk" (Tabel 'buku_peminjaman')
            $peminjaman->bukus()->attach($validated['buku_ids']);

            // 6. Kurangi Stok Setiap Buku
            foreach ($bukus as $buku) {
                // 'decrement' adalah cara aman buat ngurangin stok
                $buku->decrement('jumlah_stok'); 
            }

            // 7. Kalo semua 6 langkah di atas sukses, "Sah"-kan transaksinya
            DB::commit();

        } catch (\Exception $e) {
            // 8. Kalo ada GAGAL di langkah 3-6, batalkan semua yg udah terlanjur
            DB::rollBack();
            // Redirect balik ke form BERSAMA errornya
            return redirect()->back()
                             ->withErrors(['error' => $e->getMessage()])
                             ->withInput(); // withInput() biar form-nya gak ke-reset
        }

        // 9. Kalo semua sukses, redirect ke index
        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1. Cari data peminjaman, 'with' biar relasinya kebawa
        $peminjaman = Peminjaman::with(['anggota', 'bukus'])->findOrFail($id);

        // 2. Tampilkan halaman view baru, kirim datanya
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Mulai "Database Transaction" (Biar aman)
        try {
            DB::beginTransaction();

            // 2. Cari transaksinya
            $peminjaman = Peminjaman::findOrFail($id);

            // 3. Cek, jangan sampai udah dikembalikan tapi diklik lagi
            if ($peminjaman->status == 'Selesai') {
                throw new \Exception("Transaksi ini sudah selesai (buku sudah dikembalikan).");
            }

            // 4. Update "Struk" Peminjaman
            $peminjaman->update([
                'status' => 'Selesai',
                'tanggal_kembali_aktual' => Carbon::now()->toDateString(), // Set tanggal kembali hari ini
            ]);

            // 5. Kembalikan Stok Setiap Buku
            // 'bukus' adalah nama function relasi yg kita buat di Model Peminjaman
            foreach ($peminjaman->bukus as $buku) {
                // 'increment' adalah cara aman buat nambahin stok
                $buku->increment('jumlah_stok');
            }

            // 6. Kalo semua sukses, "Sah"-kan transaksinya
            DB::commit();

        } catch (\Exception $e) {
            // 7. Kalo ada GAGAL, batalkan semua
            DB::rollBack();
            return redirect()->route('peminjaman.index')->with('error', $e->getMessage());
        }

        // 8. Kalo semua sukses, redirect ke index
        return redirect()->route('peminjaman.index')->with('success', 'Buku telah berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
