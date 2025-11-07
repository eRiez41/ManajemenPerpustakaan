<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-6">
                        &larr; Kembali ke Daftar Anggota
                    </a>

                    {{-- DETAIL INFO ANGGOTA --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- SISI KIRI: INFO UTAMA --}}
                        <div class="md:col-span-1 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-2xl font-bold mb-2">{{ $anggota->nama_lengkap }}</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300">{{ $anggota->nomor_identitas }}</p>
                            <p class="text-md text-gray-600 dark:text-gray-400 mb-4">{{ $anggota->tipe_anggota }}</p>

                            @if($anggota->status_keanggotaan == 'Aktif')
                                <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                        
                        {{-- SISI KANAN: INFO KONTAK & ALAMAT --}}
                        <div class="md:col-span-2 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-4">Informasi Kontak</h3>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Email:</span>
                                    <p>{{ $anggota->email ?? '-' }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Nomor Telepon:</span>
                                    <p>{{ $anggota->nomor_telepon ?? '-' }}</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="font-semibold text-gray-600 dark:text-gray-400">Alamat:</span>
                                    <p>{{ $anggota->alamat ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIWAYAT PEMINJAMAN --}}
                    <h3 class="font-semibold text-lg mt-8 mb-4">Riwayat Peminjaman</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Tempo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Kembali</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($anggota->peminjamans as $peminjaman)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_pinjam }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_jatuh_tempo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_kembali_aktual ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($peminjaman->status == 'Dipinjam')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            {{-- Link ke Detail Transaksi --}}
                                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            Anggota ini belum pernah meminjam buku.
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