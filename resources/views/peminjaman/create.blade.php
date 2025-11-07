<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Transaksi Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Pilih Anggota (Dropdown) --}}
                            <div>
                                <label for="anggota_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih Anggota (Peminjam)</label>
                                <select id="anggota_id" name="anggota_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Pilih Anggota</option>
                                    @foreach ($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nomor_identitas }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanggal Pinjam (Otomatis hari ini) --}}
                            <div>
                                <label for="tanggal_pinjam" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Pinjam</label>
                                <input id="tanggal_pinjam" name="tanggal_pinjam" type="date" value="{{ old('tanggal_pinjam', now()->toDateString()) }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            {{-- Tanggal Jatuh Tempo (Otomatis 7 hari dari sekarang) --}}
                            <div>
                                <label for="tanggal_jatuh_tempo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Jatuh Tempo</label>
                                <input id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" type="date" value="{{ old('tanggal_jatuh_tempo', now()->addDays(7)->toDateString()) }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                        </div>

                        {{-- Pilih Buku (Multi-Select) --}}
                        <div class="mt-6">
                            <label for="buku_ids" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih Buku (Bisa pilih lebih dari satu)</label>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Tahan Ctrl (Windows) atau Cmd (Mac) untuk memilih banyak buku.</span>
                            <select id="buku_ids" name="buku_ids[]" multiple class="block w-full h-64 mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach ($bukus as $buku)
                                    <option value="{{ $buku->id }}">
                                        {{ $buku->judul }} (Stok: {{ $buku->jumlah_stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- TOMBOL --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('peminjaman.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>