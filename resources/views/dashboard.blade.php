<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat datang kembali, ") }} {{ Auth::user()->name }}!
                </div>
            </div>

            {{-- INI KARTU STATISTIK KITA --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                
                {{-- Kartu 1: Total Buku --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Buku
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $totalBuku }}
                        </p>
                    </div>
                </div>

                {{-- Kartu 2: Total Kategori --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Kategori
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $totalKategori }}
                        </p>
                    </div>
                </div>

                {{-- Kartu 3: Total Rak --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Rak
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $totalRak }}
                        </p>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>