<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100 dark:bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        @vite(['resources/css/app.css'])

        {{-- 
          PERUBAHAN #1: SCRIPT KILAT
          Kita tambahin script ini buat nambahin/ngapus class 'sidebar-minimized' 
          di <html> SEBELUM halaman nampil.
        --}}
        <script>
            if (localStorage.getItem('sidebarMinimized') === 'true') {
                document.documentElement.classList.add('sidebar-minimized');
            } else {
                document.documentElement.classList.remove('sidebar-minimized');
            }
        </script>
    </head>
    <body 
        class="font-sans antialiased h-full"
        x-data="{
            sidebarOpen: false,
            {{-- 
              PERUBAHAN #2: SINKRONISASI x-data
              Kita baca 'sidebarMinimized' dari class <html> yang udah di-set 
              sama 'script kilat' di atas.
            --}}
            sidebarMinimized: document.documentElement.classList.contains('sidebar-minimized'),
            darkMode: localStorage.getItem('darkMode') === 'true'
        }"
        x-init="
            // Cek dark mode awal
            if (localStorage.getItem('darkMode') === null) {
                darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
            if (darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            
            // Watcher DarkMode
            $watch('darkMode', (value) => {
                if (value) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('darkMode', 'true');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('darkMode', 'false');
                }
            });
        "
        x-cloak
    >
        
        <div class="h-full flex">
            
            <div 
                @click.outside="sidebarOpen = false"
                class="fixed inset-y-0 left-0 bg-white dark:bg-gray-800 shadow-xl z-30 transform transition-all duration-300 ease-in-out" 
                :class="{
                    'translate-x-0': sidebarOpen,
                    '-translate-x-full': !sidebarOpen,
                    'md:w-64': !sidebarMinimized,
                    'md:w-20': sidebarMinimized,
                    'md:translate-x-0': true
                }"
            >
                @include('layouts.navigation')
            </div>
            <div 
                class="flex-1 flex flex-col transition-all duration-300 ease-in-out"
                :class="{
                    'md:pl-64': !sidebarMinimized,
                    'md:pl-20': sidebarMinimized
                }"
            >
                
                <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white dark:bg-gray-800 shadow">
                    
                    {{-- Tombol Burger (Muncul di Mobile) --}}
                    <button @click.stop="sidebarOpen = !sidebarOpen" class="px-4 border-r border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-300 focus:outline-none md:hidden">
                        <span class="sr-only">Buka sidebar</span>
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    {{-- 
                      PERUBAHAN #3: SINKRONISASI @click
                      Pas tombol diklik, kita juga harus update class di <html>
                    --}}
                    <button 
                        @click="
                            sidebarMinimized = !sidebarMinimized; 
                            localStorage.setItem('sidebarMinimized', sidebarMinimized);
                            document.documentElement.classList.toggle('sidebar-minimized', sidebarMinimized);
                        " 
                        class="hidden md:block px-4 border-r border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-300 focus:outline-none" 
                        title="Minimize Sidebar"
                    >
                        <i class="fa-solid fa-bars-staggered w-5 h-5"></i>
                    </button>
                    
                    {{-- Header (Judul) & Dropdown Profil --}}
                    <div class="flex-1 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        
                        <div>
                            @if (isset($header))
                                {{ $header }}
                            @endif
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                
                                {{-- Tombol Trigger (Versi Horizontal) --}}
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                {{-- Konten Dropdown --}}
                                <x-slot name="content">
                                    <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                        <span class="mr-2">Mode:</span>
                                        <button 
                                            @click="darkMode = false"
                                            :class="!darkMode ? 'text-indigo-500' : 'text-gray-400'"
                                            title="Light Mode" class="focus:outline-none">
                                            <i class="fa-solid fa-sun w-5 h-5"></i>
                                        </button>
                                        <span class="mx-1">/</span>
                                        <button 
                                            @click="darkMode = true"
                                            :class="darkMode ? 'text-indigo-500' : 'text-gray-400'"
                                            title="Dark Mode" class="focus:outline-none">
                                            <i class="fa-solid fa-moon w-5 h-5"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        
                    </div>
                </div>

                <main class="flex-1 py-12 overflow-y-auto">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
            </div>

        @vite(['resources/js/app.js'])
    </body>
</html>