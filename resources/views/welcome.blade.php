<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Perpustakaan</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-gray-100">
        <div class="relative min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900">
            
            {{-- Tombol Login/Register di Pojok Kanan Atas --}}
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 p-6 text-right z-10">
                    @auth
                        {{-- Kalo udah login, arahin ke dashboard --}}
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        {{-- Kalo belum login, tampilkan link Login & Register --}}
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            {{-- Konten Utama Halaman --}}
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex flex-col items-center">
                    {{-- Logo atau Icon (Bisa ganti SVG-nya) --}}
                    <svg class="h-16 w-16 text-gray-700 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-9-6v12m-3 2.25h6" />
                    </svg>
                    
                    <h1 class="mt-6 text-4xl font-bold text-gray-900 dark:text-white">
                        Sistem Informasi Perpustakaan
                    </h1>
                    
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Kelola semua buku, anggota, dan transaksi peminjaman di satu tempat.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>