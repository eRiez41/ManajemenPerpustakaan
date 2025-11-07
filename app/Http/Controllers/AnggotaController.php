<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota.
     */
    public function index()
    {
        $anggotas = Anggota::latest()->get();
        return view('anggota.index', compact('anggotas'));
    }

    /**
     * Menampilkan form tambah anggota.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Menyimpan anggota baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:100|unique:anggotas',
            'tipe_anggota' => 'required|in:Mahasiswa,Dosen,Staff',
            'email' => 'nullable|email|max:255|unique:anggotas',
            'nomor_telepon' => 'nullable|string|max:20|unique:anggotas',
            'alamat' => 'nullable|string',
            'status_keanggotaan' => 'required|in:Aktif,Nonaktif',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1. Cari data anggota. Kita juga 'with' relasi peminjamans
        //    biar nanti bisa nampilin riwayat pinjam.
        $anggota = Anggota::with(['peminjamans'])->findOrFail($id);

        // 2. Tampilkan halaman view baru, kirim datanya
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Menampilkan form edit anggota.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Meng-update data anggota.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_identitas' => [
                'required',
                'string',
                'max:100',
                Rule::unique('anggotas')->ignore($anggota->id),
            ],
            'tipe_anggota' => 'required|in:Mahasiswa,Dosen,Staff',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('anggotas')->ignore($anggota->id),
            ],
            'nomor_telepon' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('anggotas')->ignore($anggota->id),
            ],
            'alamat' => 'nullable|string',
            'status_keanggotaan' => 'required|in:Aktif,Nonaktif',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diupdate!');
    }

    /**
     * Menghapus data anggota.
     */
    public function destroy(string $id)
    {
        // 1. Cari data, 'withCount' untuk ngitung "anak"-nya (peminjamans)
        $anggota = Anggota::withCount('peminjamans')->findOrFail($id);
        
        // 2. CEK PENJAGA: Anggota ini masih punya transaksi nggak?
        if ($anggota->peminjamans_count > 0) {
            // Kalo masih ada, GAGALKAN HAPUS
            return redirect()->route('anggota.index')
                             ->with('error', 'Gagal! Anggota ini sudah memiliki riwayat ' . $anggota->peminjamans_count . ' transaksi.');
        }
        
        // 3. Kalo aman, baru hapus
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}