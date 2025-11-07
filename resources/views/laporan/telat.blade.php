<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Peminjaman Telat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline mb-4">
                        &larr; Kembali ke Pusat Laporan
                    </a>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Daftar transaksi yang masih berstatus "Dipinjam" dan sudah melewati tanggal jatuh tempo.</p>
                    
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Peminjam (NIM)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Jatuh Tempo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Hari Telat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Buku yang Dipinjam</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($peminjamanTelat as $peminjaman)
                                    <tr class="bg-red-50 dark:bg-red-900/20"> {{-- Kasih highlight merah --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $peminjaman->anggota->nama_lengkap }}
                                            ({{ $peminjaman->anggota->nomor_identitas }})
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_jatuh_tempo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                                            {{-- Hitung hari telat --}}
                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->diffInDays(now()) }} hari
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $peminjaman->bukus->count() }} Buku
                                            <span class="text-xs text-gray-500">({{ $peminjaman->bukus->pluck('judul')->implode(', ') }})</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                                Lihat Transaksi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            Tidak ada data peminjaman yang telat.
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