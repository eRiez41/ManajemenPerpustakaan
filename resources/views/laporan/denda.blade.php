<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Pemasukan Denda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline mb-4">
                        &larr; Kembali ke Pusat Laporan
                    </a>
                    
                    {{-- KOTAK TOTAL DENDA --}}
                    <div class="bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-red-800 dark:text-red-200">Total Pemasukan Denda</h3>
                        <p class="text-4xl font-bold text-red-700 dark:text-red-100 mt-2">
                            Rp {{ number_format($totalDenda, 0, ',', '.') }}
                        </p>
                    </div>

                    <h3 class="font-semibold text-lg mt-8 mb-4">Rincian Transaksi Denda</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Jatuh Tempo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Kembali Aktual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah Denda</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($transaksiDenda as $transaksi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaksi->anggota->nama_lengkap }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaksi->tanggal_jatuh_tempo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaksi->tanggal_kembali_aktual }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600 dark:text-red-400">
                                            Rp {{ number_format($transaksi->total_denda, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('peminjaman.show', $transaksi->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                                Lihat Transaksi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            Belum ada transaksi denda yang tercatat.
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