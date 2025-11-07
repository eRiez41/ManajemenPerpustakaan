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
        // Skip
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
        $anggota = Anggota::findOrFail($id);
        
        // NANTI KITA TAMBAH LOGIKA:
        // Cek dulu, kalo anggota ini masih punya pinjaman, jangan boleh dihapus.
        // Untuk sekarang, kita hajar hapus aja dulu.
        
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}