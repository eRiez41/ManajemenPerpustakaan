<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- TOMBOL TAMBAH --}}
                    <a href="{{ route('buku.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-4">
                        Tambah Buku
                    </a>

                    {{-- NOTIFIKASI SUKSES --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-200 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    {{-- PESAN ERROR JIKA BUKU TIDAK DITEMUKAN (UNTUK HAPUS FOTO) --}}
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- TABEL DATA --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Rak</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Stok</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($bukus as $buku)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->penulis }}</td>
                                        {{-- Ambil nama kategori dari relasi --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->kategori->nama }}</td>
                                        {{-- Ambil kode rak dari relasi --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->rak->kode_rak }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->jumlah_stok }}</td>
                                        {{-- KODE BARU DENGAN LINK DETAIL --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            {{-- 👇 LINK BARU 👇 --}}
                                            <a href="{{ route('buku.show', $buku->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900">
                                                Detail
                                            </a>

                                            <a href="{{ route('buku.edit', $buku->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 ml-4"> {{-- <-- Tambah ml-4 --}}
                                                Edit
                                            </a>
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900" onclick="return confirm('Yakin mau hapus buku ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            Data buku masih kosong.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>