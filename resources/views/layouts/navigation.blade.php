<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="text-3xl text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fa-solid fa-house w-5 h-5 inline-block mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">
                        <i class="fa-solid fa-tags w-5 h-5 inline-block mr-2"></i>
                        {{ __('Kategori') }}
                    </x-nav-link>

                    <x-nav-link :href="route('rak.index')" :active="request()->routeIs('rak.*')">
                        <i class="fa-solid fa-box-archive w-5 h-5 inline-block mr-2"></i>
                        {{ __('Rak') }}
                    </x-nav-link>

                    <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                        <i class="fa-solid fa-book-open w-5 h-5 inline-block mr-2"></i>
                        {{ __('Buku') }}
                    </x-nav-link>

                    <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">
                        <i class="fa-solid fa-users w-5 h-5 inline-block mr-2"></i>
                        {{ __('Anggota') }}
                    </x-nav-link>

                    <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')">
                        <i class="fa-solid fa-arrow-right-arrow-left w-5 h-5 inline-block mr-2"></i>
                        {{ __('Peminjaman') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
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

                    <x-slot name="content">
                        
\                        {{-- INI KODE BARU - SATU-SATUNYA PENGATUR TEMA --}}
<div 
    x-data="{ 
        {{-- 1. Baca localStorage. Kalo 'true', set 'true'. Kalo 'false' atau null, set 'false'. --}}
        darkMode: localStorage.getItem('darkMode') === 'true'
    }"
    
    x-init="
        {{-- 
          2. Cek pas pertama kali load.
             Kalo localStorage-nya KOSONG (null), kita cek setingan OS.
        --}}
        if (localStorage.getItem('darkMode') === null) {
            darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        {{-- 
          3. Terapkan tema pas load awal berdasarkan apa pun hasilnya (localStorage atau OS)
        --}}
        if (darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        {{-- 
          4. "Pantau" variabel 'darkMode'. Kalo nilainya berubah (karena diklik),
             JALANKAN perintah untuk ganti class <html> dan simpen ke localStorage.
        --}}
        $watch('darkMode', (value) => {
            if (value) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            }
        })
    "
    class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
>
    <span class="mr-2">Mode:</span>
    
    {{-- Tombol Light (Matahari) --}}
    <button 
        @click="darkMode = false" {{-- 5. Klik HANYA mengubah variabel --}}
        :class="!darkMode ? 'text-indigo-500' : 'text-gray-400'" {{-- 6. Class REAKTIF ke variabel --}}
        title="Light Mode"
        class="focus:outline-none"
    >
        <i class="fa-solid fa-sun w-5 h-5"></i>
    </button>
    
    <span class="mx-1">/</span>
    
    {{-- Tombol Dark (Bulan) --}}
    <button 
        @click="darkMode = true" {{-- 5. Klik HANYA mengubah variabel --}}
        :class="darkMode ? 'text-indigo-500' : 'text-gray-400'" {{-- 6. Class REAKTIF ke variabel --}}
        title="Dark Mode"
        class="focus:outline-none"
    >
        <i class="fa-solid fa-moon w-5 h-5"></i>
    </button>
</div>
                        
                        {{-- Garis Pemisah --}}
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
                        {{-- 👆 KODE BARU SELESAI DI SINI 👆 --}}


                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
