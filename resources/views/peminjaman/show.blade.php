<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-6">
                        &larr; Kembali ke Daftar Peminjaman
                    </a>

                    {{-- INFORMASI UTAMA TRANSAKSI --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        {{-- Info 1: Peminjam --}}
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg">Peminjam</h3>
                            <p class="mt-1">{{ $peminjaman->anggota->nama_lengkap }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $peminjaman->anggota->nomor_identitas }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $peminjaman->anggota->tipe_anggota }}</p>
                        </div>
                        {{-- Info 2: Tanggal --}}
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg">Tanggal</h3>
                            <p class="mt-1">Pinjam: {{ $peminjaman->tanggal_pinjam }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Tempo: {{ $peminjaman->tanggal_jatuh_tempo }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kembali: {{ $peminjaman->tanggal_kembali_aktual ?? '-' }}</p>
                        </div>
                        
                        {{-- 👇 Info 3: Status & Denda (SUDAH DIUPDATE) 👇 --}}
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg">Status</h3>
                            @if($peminjaman->status == 'Dipinjam')
                                <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Dipinjam
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Selesai
                                </span>
                            @endif

                            <h3 class="font-semibold text-lg mt-4">Total Denda</h3>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                                Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- DAFTAR BUKU YANG DIPINJAM --}}
                    <h3 class="font-semibold text-lg mt-8 mb-4">Daftar Buku yang Dipinjam</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Judul Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ISBN</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($peminjaman->bukus as $buku)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->penulis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $buku->isbn ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>