<?php

namespace App\Http\Controllers;

use App\Models\Rak; // <-- PENTING
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <-- PENTING

class RakController extends Controller
{
    /**
     * Menampilkan semua rak.
     */
    public function index()
    {
        $raks = Rak::latest()->get();
        return view('rak.index', compact('raks'));
    }

    /**
     * Menampilkan form tambah rak baru.
     */
    public function create()
    {
        return view('rak.create');
    }

    /**
     * Menyimpan data rak baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_rak' => 'required|string|max:255|unique:raks',
            'lokasi' => 'nullable|string|max:255',
        ]);

        Rak::create($validated);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Kita skip ini
    }

    /**
     * Menampilkan form edit rak.
     */
    public function edit(string $id)
    {
        $rak = Rak::findOrFail($id);
        return view('rak.edit', compact('rak'));
    }

    /**
     * Meng-update data rak.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kode_rak' => [
                'required',
                'string',
                'max:255',
                Rule::unique('raks')->ignore($id),
            ],
            'lokasi' => 'nullable|string|max:255',
        ]);

        $rak = Rak::findOrFail($id);
        $rak->update($validated);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil diupdate!');
    }

    /**
     * Menghapus data rak.
     */
    public function destroy(string $id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus!');
    }
}