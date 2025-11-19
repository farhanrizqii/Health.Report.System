<?php
// Ambil objek user yang sedang login
$user = auth()->user();

// Menggunakan NULL SAFE OPERATOR (?->) untuk mencegah error jika relasi 'role' adalah NULL.
$userRole = $user?->role?->nama_role; 
?>

<!-- Font Awesome - HARUS DIMUAT TERLEBIH DAHULU -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ========== GLOBAL STYLES ========== */
    * {
        font-family: 'Montserrat', sans-serif !important;
    }
    
    /* FIX: Pastikan icon font tetap menggunakan Font Awesome */
    .fa, .fas, .far, .fal, .fab {
        font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
        font-weight: 900 !important;
    }

    /* ========== NAVBAR (Top Bar) ========== */
    nav.bg-white {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02) !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0 !important;
    }

    .dark nav.bg-white {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
        border-bottom-color: #334155 !important;
    }

    /* Navbar Container */
    nav .max-w-7xl {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 70px;
        padding: 0 1.5rem;
    }

    nav .flex.justify-between {
        width: 100%;
        align-items: center;
    }

    /* Logo SehatKu Container */
    .sehatku-logo-nav {
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s ease;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 10px;
    }

    .sehatku-logo-nav:hover {
        transform: translateY(-1px);
        background: rgba(0, 123, 255, 0.03);
    }

    .sehatku-logo-nav .icon-box {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .sehatku-logo-nav:hover .icon-box {
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.35);
        transform: scale(1.05);
    }

    .sehatku-logo-nav .icon-box i {
        font-size: 22px;
        color: white;
    }

    .sehatku-logo-nav .text {
        font-size: 1.625rem;
        font-weight: 700;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
        line-height: 1;
    }

    /* Left Section - Better alignment */
    nav .flex.items-center {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* Nav Links Container */
    .nav-links-container {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 24px;
    }

    /* Individual Nav Link */
    .nav-link-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9375rem;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        border-bottom: 2px solid transparent;
    }

    .nav-link-item:hover {
        background: #eff6ff;
        color: #007bff;
    }

    .nav-link-item.active {
        background: #eff6ff;
        color: #007bff;
        font-weight: 600;
        border-bottom-color: #007bff;
    }

    .dark .nav-link-item {
        color: #cbd5e1;
    }

    .dark .nav-link-item:hover,
    .dark .nav-link-item.active {
        background: #1e3a8a;
        color: #60a5fa;
    }

    .dark .nav-link-item.active {
        border-bottom-color: #0369a1;
    }

    /* User Info Styling */
    .user-info-section {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #475569; 
        font-weight: 500;
        font-size: 0.9375rem;
        padding: 10px 18px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .dark .user-info-section {
        background: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }

    .user-info-section i {
        font-size: 18px;
        color: #64748b;
    }

    .dark .user-info-section i {
        color: #94a3b8;
    }

    .user-info-section .user-name {
        font-weight: 600;
        color: #1e293b;
    }

    .dark .user-info-section .user-name {
        color: #f1f5f9;
    }

    .user-info-section .role-text {
        color: #007bff !important; 
        font-weight: 600;
    }

    .dark .user-info-section .role-text {
        color: #60a5fa !important;
    }

    /* Right Section - Better spacing */
    .nav-right-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    /* Dropdown Button (Pengaturan) */
    .dropdown-trigger-btn {
        background: #ffffff; 
        border: 1px solid #cbd5e1; 
        color: #475569;
        font-weight: 600;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        padding: 10px 20px; 
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .dropdown-trigger-btn i {
        font-size: 16px;
    }

    .dropdown-trigger-btn:hover {
        background: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
        transform: translateY(-1px);
    }

    .dark .dropdown-trigger-btn {
        background: #1e293b;
        border-color: #334155;
        color: #cbd5e1;
    }

    .dark .dropdown-trigger-btn:hover {
        background: #0369a1;
        border-color: #0369a1;
        color: white;
    }
    
    /* Dropdown Links */
    .x-dropdown-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .x-dropdown-link:hover {
        background-color: #eff6ff; 
        color: #007bff;
    }

    .dark .x-dropdown-link:hover {
        background-color: #1e3a8a;
        color: #60a5fa;
    }

    .x-dropdown-link i {
        width: 18px;
        color: #64748b;
    }

    .x-dropdown-link:hover i {
        color: #007bff;
    }

    .dark .x-dropdown-link i {
        color: #94a3b8;
    }

    .dark .x-dropdown-link:hover i {
        color: #60a5fa;
    }

    /* Hamburger Button (Mobile) */
    .hamburger-btn {
        color: #475569;
        transition: all 0.2s ease;
        padding: 10px;
        border-radius: 8px;
    }

    .hamburger-btn:hover {
        background-color: #f1f5f9;
        color: #007bff;
    }

    .dark .hamburger-btn {
        color: #cbd5e1;
    }

    .dark .hamburger-btn:hover {
        background-color: #1e293b;
        color: #60a5fa;
    }

    /* Hide nav links on mobile */
    @media (max-width: 640px) {
        .nav-links-container {
            display: none;
        }
        
        nav .max-w-7xl {
            height: 64px;
            padding: 0 1rem;
        }
        
        .sehatku-logo-nav .text {
            font-size: 1.375rem;
        }
        
        .sehatku-logo-nav .icon-box {
            width: 38px;
            height: 38px;
        }
        
        .sehatku-logo-nav .icon-box i {
            font-size: 18px;
        }
    }

    /* ========== SIDEBAR MOBILE ========== */
    .sidebar-responsive {
        background-color: #ffffff; 
        box-shadow: -4px 0 16px rgba(0, 0, 0, 0.1);
    }

    .dark .sidebar-responsive {
        background-color: #1e293b;
        box-shadow: -4px 0 16px rgba(0, 0, 0, 0.3);
    }

    /* Sidebar Header */
    .sidebar-header {
        background: #f8fafc; 
        border-bottom: 1px solid #e2e8f0;
        padding: 16px 20px;
    }

    .dark .sidebar-header {
        background: #0f172a;
        border-bottom-color: #334155;
    }

    /* Sidebar Section Headers */
    .sidebar-section-header {
        color: #64748b; 
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 20px 8px 20px;
        margin-top: 8px;
        background: #f8fafc; 
        border-left: 3px solid #007bff;
    }

    .dark .sidebar-section-header {
        color: #94a3b8;
        background: #0f172a;
        border-left-color: #0369a1;
    }

    /* Sidebar Links */
    .sidebar-responsive a {
        color: #475569 !important; 
        font-weight: 500;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        text-decoration: none;
    }

    .dark .sidebar-responsive a {
        color: #cbd5e1 !important;
    }

    /* Icon di sidebar links */
    .sidebar-responsive a i {
        width: 20px;
        font-size: 16px;
        text-align: center;
        color: #64748b;
        transition: color 0.2s ease;
    }

    .dark .sidebar-responsive a i {
        color: #94a3b8;
    }
    
    /* Link Aktif dan Hover */
    .sidebar-responsive a:hover,
    .sidebar-responsive a.active { 
        background-color: #eff6ff !important; 
        color: #007bff !important; 
        border-left-color: #007bff !important;
        padding-left: 24px !important; 
        font-weight: 600;
    }

    .sidebar-responsive a:hover i,
    .sidebar-responsive a.active i {
        color: #007bff;
    }

    .dark .sidebar-responsive a:hover,
    .dark .sidebar-responsive a.active { 
        background-color: #1e3a8a !important; 
        color: #60a5fa !important; 
        border-left-color: #0369a1 !important;
    }

    .dark .sidebar-responsive a:hover i,
    .dark .sidebar-responsive a.active i {
        color: #60a5fa;
    }
    
    /* Sidebar Close Button */
    .sidebar-close-btn {
        color: #64748b;
        transition: all 0.2s ease;
        padding: 8px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
    }

    .sidebar-close-btn:hover {
        color: #007bff;
        background: #eff6ff;
    }

    .dark .sidebar-close-btn {
        color: #94a3b8;
    }

    .dark .sidebar-close-btn:hover {
        color: #60a5fa;
        background: #1e3a8a;
    }

    .sidebar-close-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Overlay Background */
    .sidebar-overlay {
        backdrop-filter: blur(3px);
    }

    /* Nav Link Active State */
    .nav-link-active {
        border-bottom: 2px solid #007bff;
        color: #007bff !important;
        font-weight: 600;
    }

    .dark .nav-link-active {
        border-bottom-color: #0369a1;
        color: #60a5fa !important;
    }
</style>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            
            <!-- Left Section: Hamburger + Logo + Nav Links -->
            <div class="flex items-center">
                
                <!-- Hamburger Menu -->
                <button @click="open = !open" class="hamburger-btn inline-flex items-center justify-center rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
                <!-- Logo SehatKu -->
                <a href="{{ route('dashboard') }}" class="sehatku-logo-nav">
                    <div class="icon-box">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <span class="text">SehatKu</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="nav-links-container hidden sm:flex">
                    <a href="{{ route('dashboard') }}" class="nav-link-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
            
            <!-- Right Section: User Info + Settings -->
            <div class="nav-right-section hidden sm:flex">
                
                <!-- User Info -->
                @if (Auth::user())
                    <div class="user-info-section">
                        <i class="fas fa-user-circle"></i>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="role-text">({{ $userRole ?? 'N/A' }})</span>
                    </div>
                @endif
                
                <!-- Dropdown Settings -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="dropdown-trigger-btn focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out duration-200">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span> 
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="x-dropdown-link">
                            <i class="fas fa-user-edit"></i>
                            <span>{{ __('Profile') }}</span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="x-dropdown-link"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Overlay Background -->
    <div x-show="open" 
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false" 
        class="sidebar-overlay fixed inset-0 bg-gray-900 bg-opacity-50 z-40 sm:hidden">
    </div>

    <!-- Mobile Sidebar -->
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform -translate-x-full"
        x-transition:enter-end="transform translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform translate-x-0"
        x-transition:leave-end="transform -translate-x-full"
        class="sidebar-responsive fixed inset-y-0 left-0 w-72 shadow-2xl z-50 overflow-y-auto"> 
        
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sehatku-logo-nav">
                <div class="icon-box">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <span class="text">SehatKu</span>
            </a>
            <button @click="open = false" class="sidebar-close-btn">
                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <div class="py-2">
            
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>

            <!-- Master Data Section (Admin Only) -->
            @if ($userRole == 'Admin')
                <div class="sidebar-section-header">
                    <span>{{ __('Master Data') }}</span>
                </div>
                <a href="{{ route('wilayah.index') }}" class="{{ request()->routeIs('wilayah.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>{{ __('Data Wilayah') }}</span>
                </a>
                <a href="{{ route('fasilitas-kesehatan.index') }}" class="{{ request()->routeIs('fasilitas-kesehatan.*') ? 'active' : '' }}">
                    <i class="fas fa-hospital"></i>
                    <span>{{ __('Fasilitas Kesehatan') }}</span>
                </a>
                <a href="{{ route('kategori-penyakit.index') }}" class="{{ request()->routeIs('kategori-penyakit.*') ? 'active' : '' }}">
                    <i class="fas fa-disease"></i>
                    <span>{{ __('Kategori Penyakit') }}</span>
                </a>
            @endif

            <!-- Pencatatan Data Section -->
            <div class="sidebar-section-header">
                <span>{{ __('Pencatatan Data') }}</span>
            </div>
            <a href="{{ route('penduduk.index') }}" class="{{ request()->routeIs('penduduk.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>{{ __('Data Penduduk') }}</span>
            </a>
            <a href="{{ route('ibuhamil.index') }}" class="{{ request()->routeIs('ibuhamil.*') ? 'active' : '' }}">
                <i class="fas fa-baby"></i>
                <span>{{ __('Data Ibu Hamil') }}</span>
            </a>
            <a href="{{ route('imunisasi.index') }}" class="{{ request()->routeIs('imunisasi.*') ? 'active' : '' }}">
                <i class="fas fa-syringe"></i>
                <span>{{ __('Data Imunisasi') }}</span>
            </a>
            <a href="{{ route('riwayat-kesehatan.index') }}" class="{{ request()->routeIs('riwayat-kesehatan.*') ? 'active' : '' }}">
                <i class="fas fa-notes-medical"></i>
                <span>{{ __('Riwayat Kesehatan') }}</span>
            </a>

            <!-- Pelaporan & Kegiatan Section -->
            <div class="sidebar-section-header">
                <span>{{ __('Pelaporan & Kegiatan') }}</span>
            </div>
            <a href="{{ route('laporan-kesehatan.index') }}" class="{{ request()->routeIs('laporan-kesehatan.*') ? 'active' : '' }}">
                <i class="fas fa-file-medical-alt"></i>
                <span>{{ __('Laporan Harian (Petugas)') }}</span>
            </a>
            <a href="{{ route('kegiatan-posyandu.index') }}" class="{{ request()->routeIs('kegiatan-posyandu.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>{{ __('Kegiatan Posyandu') }}</span>
            </a>
            
            <!-- Account Section -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-edit"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Log Out') }}</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>