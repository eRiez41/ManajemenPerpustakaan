<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- INI KONTAINER GRID UTAMA --}}
        <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
            
            <div class="hidden md:flex bg-gradient-to-r from-gray-700 via-gray-900 to-black items-center justify-center p-12">
                <div class="text-center">
                    <i class="fa-solid fa-book-open text-white" style="font-size: 8rem;"></i>
                    <h1 class="text-3xl font-bold text-white mt-6">
                        App Manajemen Perpustakaan
                    </h1>
                    <p class="mt-2 text-gray-300">
                        Selamat datang. Silakan login untuk mengelola data.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900 p-6 sm:p-12">
                
                <div class="mb-6">
                    <a href="/">
                        <x-application-logo class="text-gray-800 dark:text-gray-200" style="font-size: 4rem;" />
                    </a>
                </div>
                
                <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }} {{-- Ini adalah isi dari login.blade.php atau register.blade.php --}}
                </div>
            </div>
        </div>
    </body>
</html>