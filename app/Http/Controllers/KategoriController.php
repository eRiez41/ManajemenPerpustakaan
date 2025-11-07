<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kategori, urutkan dari yg terbaru
        $kategoris = Kategori::latest()->get(); 

        // Tampilkan halaman view, sambil kirim data $kategoris
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cuma nampilin halaman form tambah data
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris', // Wajib diisi, unik di tabel kategoris
            'deskripsi' => 'nullable|string', // Boleh kosong
        ]);

        // 2. Simpan data ke database
        Kategori::create($validated);

        // 3. Redirect (balikin) ke halaman index
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. Cari data kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id); // findOrFail = cari, kalo gak nemu, otomatis 404

        // 2. Tampilkan halaman form edit sambil kirim data $kategori
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        // 1. Validasi data
        $validated = $request->validate([
            // Validasi 'nama' harus unik, KECUALI untuk ID-nya sendiri
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategoris')->ignore($id),
            ],
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Cari data berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // 3. Update data di database
        $kategori->update($validated);

        // 4. Redirect ke halaman index dengan notifikasi sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari data berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // 2. Hapus data dari database
        $kategori->delete();

        // 3. Redirect ke halaman index dengan notifikasi sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
