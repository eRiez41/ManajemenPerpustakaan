<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('buku.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-6">
                        &larr; Kembali ke Daftar Buku
                    </a>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        {{-- SISI KIRI: COVER BUKU --}}
                        <div class="md:col-span-1">
                            @if($buku->cover)
                                <img src="{{ asset('storage/covers/' . $buku->cover) }}" alt="Cover Buku" class="w-full h-auto object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg shadow-md">
                                    <span class="text-gray-500">Tidak ada cover</span>
                                </div>
                            @endif
                        </div>

                        {{-- SISI KANAN: DETAIL INFO BUKU --}}
                        <div class="md:col-span-2">
                            <h3 class="text-3xl font-bold mb-2">{{ $buku->judul }}</h3>
                            <p class="text-xl text-gray-700 dark:text-gray-300 mb-4">{{ $buku->penulis }}</p>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Penerbit:</span>
                                    <p>{{ $buku->penerbit }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Tahun Terbit:</span>
                                    <p>{{ $buku->tahun_terbit }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">ISBN:</span>
                                    <p>{{ $buku->isbn ?? '-' }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Kategori:</span>
                                    <p>{{ $buku->kategori->nama }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Lokasi Rak:</span>
                                    <p>{{ $buku->rak->kode_rak }} ({{ $buku->rak->lokasi }})</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Harga:</span>
                                    <p>Rp {{ number_format($buku->harga_buku, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Stok:</span>
                                    <p class="font-bold text-lg {{ $buku->jumlah_stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $buku->jumlah_stok }}
                                    </p>
                                </div>
                            </div>
                            
                            {{-- DESKRIPSI --}}
                            <div class="mt-6">
                                <span class="font-semibold text-gray-600 dark:text-gray-400">Deskripsi:</span>
                                <p class="mt-2 text-gray-700 dark:text-gray-300">
                                    {{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>