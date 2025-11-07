<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // <-- PENTING: Untuk urus file

class BukuController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     */
    public function index()
    {
        // 'with' (Eager Loading) biar lebih efisien, nggak nanya DB berulang kali
        $bukus = Buku::with(['kategori', 'rak'])->latest()->get();
        return view('buku.index', compact('bukus'));
    }

    /**
     * Menampilkan form tambah buku baru.
     */
    public function create()
    {
        // Ambil data kategori & rak untuk dikirim ke form (buat dropdown)
        $kategoris = Kategori::orderBy('nama')->get();
        $raks = Rak::orderBy('kode_rak')->get();
        return view('buku.create', compact('kategoris', 'raks'));
    }

    /**
     * Menyimpan data buku baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:'.date('Y'), // Tahun min 1000, max tahun ini
            'isbn' => 'nullable|string|max:20|unique:bukus',
            'harga_buku' => 'required|integer|min:0',
            'jumlah_stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Opsional, gambar, max 2MB
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id', // Harus ada di tabel kategoris
            'rak_id' => 'required|exists:raks,id', // Harus ada di tabel raks
        ]);

        // 2. Handle Upload Cover (Jika ada)
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            // Buat nama file unik (misal: 123456789_cover_buku_dilan.jpg)
            $filename = time() . '_cover_' . $file->getClientOriginalName();
            
            // Simpan file ke storage/app/public/covers
            $file->storeAs('public/covers', $filename);
            
            // Simpan nama file-nya ke data yang akan divalidasi
            $validated['cover'] = $filename;
        }

        // 3. Simpan data ke database
        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Kita skip ini
    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::orderBy('nama')->get();
        $raks = Rak::orderBy('kode_rak')->get();
        
        return view('buku.edit', compact('buku', 'kategoris', 'raks'));
    }

    /**
     * Meng-update data buku.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        // 1. Validasi
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:'.date('Y'),
            // Validasi unik, tapi abaikan ID buku ini sendiri
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('bukus')->ignore($id)],
            'harga_buku' => 'required|integer|min:0',
            'jumlah_stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
        ]);

        // 2. Handle Update Cover (Jika ada file baru)
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($buku->cover) {
                Storage::delete('public/covers/' . $buku->cover);
            }

            // Upload cover baru
            $file = $request->file('cover');
            $filename = time() . '_cover_' . $file->getClientOriginalName();
            $file->storeAs('public/covers', $filename);
            
            // Simpan nama file baru
            $validated['cover'] = $filename;
        }

        // 3. Update data ke database
        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate!');
    }

    /**
     * Menghapus data buku.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        // Jika buku tidak ditemukan, kasih pesan error
        if (!$buku) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan.');
        }

        // Hapus cover dari storage jika ada
        if ($buku->cover) {
            Storage::delete('public/covers/' . $buku->cover);
        }

        // Hapus data buku dari database
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}