<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- FORM FILTER KATEGORI --}}
                    <form action="{{ route('laporan.buku') }}" method="GET" class="mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <label for="kategori_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Filter berdasarkan Kategori:</label>
                                <select id="kategori_id" name="kategori_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $selectedKategori == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="self-end inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Filter
                            </button>
                            <a href="{{ route('laporan.buku') }}" class="self-end inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                                Reset
                            </a>
                        </div>
                    </form>
                    
                    {{-- Tombol Kembali ke Hub --}}
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline mb-4">
                        &larr; Kembali ke Pusat Laporan
                    </a>

                    {{-- TABEL DATA BUKU --}}
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Rak</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ISBN</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($bukus as $buku)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->penulis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->kategori->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->rak->kode_rak }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->jumlah_stok }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->isbn ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            Tidak ada data buku yang cocok.
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