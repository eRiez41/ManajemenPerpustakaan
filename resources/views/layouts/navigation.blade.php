<div class="flex flex-col h-full">
    
    <div 
        class="flex-shrink-0 flex items-center justify-center h-16 px-4 bg-gray-50 dark:bg-gray-700 transition-all duration-300"
        :class="sidebarMinimized ? 'md:px-2' : 'md:px-4'"
    >
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 overflow-hidden">
            <x-application-logo class="text-3xl text-gray-800 dark:text-gray-200 flex-shrink-0" />
            <span 
                class="font-semibold text-lg text-gray-800 dark:text-gray-200 whitespace-nowrap transition-opacity duration-200"
                :class="sidebarMinimized ? 'md:opacity-0 md:hidden' : 'opacity-100'"
            >
                PerpusApp
            </span>
        </a>
    </div>
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">
        
        <style>
            .sidebar-link {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 0.75rem 1rem; /* py-3 px-4 */
                font-medium;
                font-size: 0.875rem; /* text-sm */
                transition: all 0.15s ease-in-out;
            }
            .sidebar-link:hover {
                background-color: theme('colors.gray.100');
                color: theme('colors.gray.900');
            }
            .sidebar-link:hover.dark {
                background-color: theme('colors.gray.700');
                color: theme('colors.white');
            }
            .sidebar-link.active {
                background-color: theme('colors.indigo.50');
                color: theme('colors.indigo.600');
                border-left-width: 4px;
                border-color: theme('colors.indigo.500');
                padding-left: 0.75rem; /* px-3 */
            }
            .sidebar-link.active.dark {
                background-color: theme('colors.gray.900');
                color: theme('colors.indigo.400');
                border-color: theme('colors.indigo.400');
            }

            /* Style tambahan untuk mode minimize */
            .sidebar-minimized .sidebar-link {
                justify-content: center;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            .sidebar-minimized .sidebar-link.active {
                /* Saat minimize, border kiri geser jadi border kanan */
                border-left-width: 0;
                border-right-width: 4px;
                padding-left: 0.5rem;
            }
            .sidebar-minimized .sidebar-link .sidebar-text {
                /* Sembunyikan teks */
                opacity: 0;
                display: none;
            }
            
            /* Class baru untuk styling dropdown laporan */
            .sidebar-dropdown-trigger {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 0.75rem 1rem; /* py-3 px-4 */
                font-medium;
                font-size: 0.875rem; /* text-sm */
                transition: all 0.15s ease-in-out;
            }
            .sidebar-minimized .sidebar-dropdown-trigger {
                justify-content: center;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        </style>

        <div :class="sidebarMinimized ? 'sidebar-minimized' : ''">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-gauge-high w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Dashboard') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-tags w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Kategori') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('rak.index')" :active="request()->routeIs('rak.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-box-archive w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Rak') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-book-open w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Buku') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-users w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Anggota') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-arrow-right-arrow-left w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Peminjaman') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')" class="sidebar-link dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" active-class="active dark:active">
                <i class="fa-solid fa-chart-pie w-5 h-5 inline-block flex-shrink-0"></i>
                <span class="ms-3 sidebar-text">{{ __('Laporan') }}</span>
            </x-nav-link>

        </div>
    </nav>
    </div>