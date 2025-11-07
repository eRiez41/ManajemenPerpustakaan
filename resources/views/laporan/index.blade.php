<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pusat Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kita ganti jadi 3 kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Tombol Laporan Buku --}}
                <a href="{{ route('laporan.buku') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-book-open text-4xl text-indigo-500 dark:text-indigo-400 mb-3"></i>
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Laporan Buku</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Inventaris lengkap buku (plus filter kategori).</p>
                </a>

                {{-- Tombol Laporan Anggota --}}
                <a href="{{ route('laporan.anggota') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-users text-4xl text-green-500 dark:text-green-400 mb-3"></i>
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Laporan Anggota</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Daftar lengkap semua anggota yang terdaftar.</p>
                </a>
                
                {{-- Tombol Laporan Buku Terpopuler --}}
                <a href="{{ route('laporan.populer') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-fire text-4xl text-red-500 dark:text-red-400 mb-3"></i>
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Buku Terpopuler</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Daftar buku yang paling sering dipinjam.</p>
                </a>

                {{-- Tombol Laporan Anggota Teraktif --}}
                <a href="{{ route('laporan.aktif') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-star text-4xl text-yellow-500 dark:text-yellow-400 mb-3"></i>
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Anggota Teraktif</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Daftar anggota yang paling sering meminjam.</p>
                </a>

                {{-- Tombol Laporan Denda --}}
                <a href="{{ route('laporan.denda') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-dollar-sign text-4xl text-blue-500 dark:text-blue-400 mb-3"></i>
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Laporan Denda</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Total pemasukan denda dan rincian transaksinya.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>