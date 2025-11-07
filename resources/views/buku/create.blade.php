<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Tampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORMULIR --}}
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- INI CLASS YANG BENAR --}}
                            <div>
                                <label for="judul" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Judul</label>
                                <input id="judul" name="judul" type="text" value="{{ old('judul') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                            </div>

                            <div>
                                <label for="penulis" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Penulis</label>
                                <input id="penulis" name="penulis" type="text" value="{{ old('penulis') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <label for="penerbit" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Penerbit</label>
                                <input id="penerbit" name="penerbit" type="text" value="{{ old('penerbit') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <label for="tahun_terbit" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tahun Terbit</label>
                                <input id="tahun_terbit" name="tahun_terbit" type="number" value="{{ old('tahun_terbit') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <label for="isbn" class="block font-medium text-sm text-gray-700 dark:text-gray-300">ISBN (Opsional)</label>
                                <input id="isbn" name="isbn" type="text" value="{{ old('isbn') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="harga_buku" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Harga Buku</label>
                                <input id="harga_buku" name="harga_buku" type="number" value="{{ old('harga_buku', 0) }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <label for="jumlah_stok" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                                <input id="jumlah_stok" name="jumlah_stok" type="number" value="{{ old('jumlah_stok', 0) }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <label for="cover" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cover Buku (Opsional)</label>
                                <input id="cover" name="cover" type="file" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 p-1.5 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="kategori_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kategori</label>
                                <select id="kategori_id" name="kategori_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="rak_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Rak</label>
                                <select id="rak_id" name="rak_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Pilih Rak</option>
                                    @foreach ($raks as $rak)
                                        <option value="{{ $rak->id }}" {{ old('rak_id') == $rak->id ? 'selected' : '' }}>
                                            {{ $rak->kode_rak }} - {{ $rak->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Deskripsi (Opsional)</label>
                                <textarea id="deskripsi" name="deskripsi" rows="4" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>

                        {{-- TOMBOL --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('buku.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>