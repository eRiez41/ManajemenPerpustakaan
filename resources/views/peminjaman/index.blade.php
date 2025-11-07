<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-4">
                        + Buat Transaksi Baru
                    </a>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-200 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Peminjam (NIM)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Tempo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jml Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Denda</th> {{-- <-- KOLOM BARU --}}
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    
    @forelse ($peminjamans as $peminjaman)
        
        {{-- 👇 1. TAMBAH CLASS & ONCLICK DI SINI 👇 --}}
        <tr 
            class="cursor-pointer transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700" 
            onclick="window.location='{{ route('peminjaman.show', $peminjaman->id) }}'"
        >
            
            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loop->iteration }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                {{ $peminjaman->anggota->nama_lengkap }} 
                ({{ $peminjaman->anggota->nomor_identitas }})
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_pinjam }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->tanggal_jatuh_tempo }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $peminjaman->bukus->count() }} Buku</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                @if($peminjaman->status == 'Dipinjam')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        Dipinjam
                    </span>
                @elseif($peminjaman->status == 'Selesai')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        Selesai
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $peminjaman->status }}
                    </span>
                @endif
            </td>
            
            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">
                Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}
            </td>
            
            {{-- 👇 2. HAPUS LINK 'DETAIL' & 3. TAMBAH 'stopPropagation' 👇 --}}
            <td 
                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" 
                onclick="event.stopPropagation()" {{-- Ini biar klik <td> ini gak ngebuka detail --}}
            >
                {{-- Link 'Detail' Dihapus dari sini --}}

                @if($peminjaman->status == 'Dipinjam')
                    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="inline-block"> {{-- Hapus ml-4 --}}
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-green-600 dark:text-green-400 hover:text-green-900" onclick="return confirm('Konfirmasi pengembalian buku?')">
                            Kembalikan
                        </button>
                    </form>
                @else
                    <span class="text-gray-500 dark:text-gray-400 inline-block"> {{-- Hapus ml-4 --}}
                        Selesai
                    </span>
                @endif
            </td>
        
        </tr>

    @empty
        <tr>
            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                Belum ada transaksi peminjaman.
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