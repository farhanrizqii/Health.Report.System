<?php
// Ambil objek user yang sedang login
$user = auth()->user();
$userRole = $user ? $user->role->nama_role : null;
?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex items-center">
                
                <div class="-ms-3 flex items-center"> 
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus->text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="shrink-0 flex items-center ms-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>
            
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="text-sm me-3 text-gray-700 dark:text-gray-300">
                    {{ Auth::user()->name }} ({{ $userRole }})
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>Pengaturan</div> 
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
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
            
            <div class="-me-2 flex items-center sm:hidden">
                </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform -translate-x-full"
         class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-xl z-50 overflow-y-auto sm:hidden">
        
        <div class="px-4 py-3 flex items-center justify-between border-b dark:border-gray-700">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <button @click="open = false" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <div class="pb-3 border-t border-gray-200 dark:border-gray-600 mt-2">
                @if ($userRole == 'Admin')
                    <div class="px-4 pt-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        {{ __('MASTER DATA') }}
                    </div>
                    <x-responsive-nav-link :href="route('wilayah.index')" :active="request()->routeIs('wilayah.*')">{{ __('Data Wilayah') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('fasilitas-kesehatan.index')" :active="request()->routeIs('fasilitas-kesehatan.*')">{{ __('Fasilitas Kesehatan') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('kategori-penyakit.index')" :active="request()->routeIs('kategori-penyakit.*')">{{ __('Kategori Penyakit') }}</x-responsive-nav-link>
                @endif

                <div class="px-4 pt-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {{ __('PENCATATAN DATA') }}
                </div>
                <x-responsive-nav-link :href="route('penduduk.index')" :active="request()->routeIs('penduduk.*')">{{ __('Data Penduduk') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ibuhamil.index')" :active="request()->routeIs('ibuhamil.*')">{{ __('Data Ibu Hamil') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('imunisasi.index')" :active="request()->routeIs('imunisasi.*')">{{ __('Data Imunisasi') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('riwayat-kesehatan.index')" :active="request()->routeIs('riwayat-kesehatan.*')">{{ __('Riwayat Kesehatan') }}</x-responsive-nav-link>

                <div class="px-4 pt-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {{ __('PELAPORAN & KEGIATAN') }}
                </div>
                <x-responsive-nav-link :href="route('laporan-kesehatan.index')" :active="request()->routeIs('laporan-kesehatan.*')">{{ __('Laporan Harian (Petugas)') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kegiatan-posyandu.index')" :active="request()->routeIs('kegiatan-posyandu.*')">{{ __('Kegiatan Posyandu') }}</x-responsive-nav-link>
                
                <div class="mt-3 space-y-1 border-t border-gray-200 dark:border-gray-600">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>