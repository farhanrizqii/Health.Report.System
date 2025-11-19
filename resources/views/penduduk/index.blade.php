<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Data Penduduk') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Menggunakan gaya 'chart-card' untuk container utama */
        .data-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px; 
            transition: all 0.3s ease;
        }

        .dark .data-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        /* Styling untuk Button Aksi */
        .btn-tambah, .btn-ekspor {
            border-radius: 10px;
            padding: 10px 20px; 
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            white-space: nowrap; 
        }

        .btn-tambah {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        .btn-ekspor {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        .btn-ekspor:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4);
        }

        /* Input Pencarian */
        .search-input {
            width: 100%;
            padding: 10px 16px;
            border-radius: 10px 0 0 10px;
            border: 1px solid #cbd5e1;
            border-right: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 0.9375rem;
            color: #1F2937; 
        }

        .search-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 1px #007bff;
            outline: none;
        }

        .dark .search-input {
             background-color: #374151; 
             border-color: #4b5563;
             color: #f3f4f6; 
        }
        .dark .search-input:focus {
            box-shadow: 0 0 0 1px #60a5fa;
            border-color: #60a5fa;
        }
        
        /* Search button dengan label */
        .btn-cari {
            background-color: #007bff;
            color: white;
            padding: 10px 20px; 
            border-radius: 0 10px 10px 0;
            height: 40px; 
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .btn-cari:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }
        
        /* Tabel Styling */
        .data-table {
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); 
        }

        .data-table thead {
            background-color: #F3F4F6; 
            color: #1F2937;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.875rem;
            border-bottom: 3px solid #007bff; 
        }
        
        .dark .data-table thead {
             background-color: #1F2937; 
             color: #F3F4F6;
             border-bottom-color: #60a5fa;
        }

        .data-table th {
            padding: 14px 20px;
            border: none;
        }
        
        /* Baris data */
        .data-table tbody tr {
            transition: background-color 0.2s ease;
        }
        .data-table tbody tr:hover {
            background-color: #eff6ff; 
        }
        
        .dark .data-table tbody tr:hover {
            background-color: #1e3a8a;
        }

        .data-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            vertical-align: middle;
        }
        
        .dark .data-table td {
            border-bottom-color: #334155;
            color: #cbd5e1;
        }

        /* Action Links Styling */
        .action-link {
            font-weight: 600;
            font-size: 0.875rem;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-width: 75px;
            justify-content: center;
        }
        
        .link-detail { 
            background-color: #ECFDF5; 
            color: #059669; 
        }
        .link-detail:hover {
            background-color: #D1FAE5;
            transform: translateY(-1px);
        }
        
        .link-edit { 
            background-color: #EFF6FF; 
            color: #2563EB; 
        }
        .link-edit:hover {
            background-color: #DBEAFE;
            transform: translateY(-1px);
        }
        
        /* Tombol Hapus dengan outline style */
        .link-hapus { 
            background-color: transparent;
            color: #DC2626;
            border: 2px solid #DC2626;
        }
        .link-hapus:hover {
            background-color: #DC2626;
            color: white;
            transform: translateY(-1px);
        }
        
        .dark .link-hapus {
            color: #EF4444;
            border-color: #EF4444;
        }
        .dark .link-hapus:hover {
            background-color: #EF4444;
            color: white;
        }
        
        /* Pagination Styling */
        .pagination-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: space-between; 
            align-items: center;
            color: #475569;
            font-size: 0.9375rem;
        }
        .dark .pagination-container {
            color: #cbd5e1;
        }
        
        .pagination-links > div {
             display: flex;
             gap: 4px;
             align-items: center;
        }

        /* Styling untuk Tombol Paginasi */
        .pagination-links a, 
        .pagination-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            border: 1px solid #E5E7EB; 
            background-color: white;
            color: #475569;
        }
        .dark .pagination-links a, 
        .dark .pagination-links span {
             background-color: #374151;
             border-color: #4b5563;
             color: #cbd5e1;
        }

        /* Tombol Aktif */
        .pagination-links span.bg-blue-500 {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
            box-shadow: 0 0 0 1px #007bff;
        }

        /* TOAST NOTIFICATION STYLING */
        .toast-notification {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-left: 5px solid #10B981;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            color: #065f46; 
            padding: 18px 24px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 9999;
            max-width: 420px;
            font-size: 0.95rem;
            backdrop-filter: blur(10px);
        }

        .dark .toast-notification {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            border-left-color: #34D399;
            color: #34D399;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .toast-notification.error {
            border-left-color: #EF4444;
            color: #991B1B;
        }

        .dark .toast-notification.error {
            border-left-color: #F87171;
            color: #FCA5A5;
        }

        .toast-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .toast-content {
            flex: 1;
            line-height: 1.5;
        }

        .toast-close {
            font-size: 1.25rem;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s ease;
            flex-shrink: 0;
            padding: 4px;
        }

        .toast-close:hover {
            opacity: 1;
        }

        /* Container untuk action buttons */
        .action-buttons-container {
            display: flex;
            gap: 12px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 640px) {
             .action-buttons-container {
                flex-direction: column;
                width: 100%;
             }
             .btn-tambah, .btn-ekspor {
                width: 100%;
                justify-content: center;
             }
             .btn-cari span {
                 display: none;
             }
             .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                text-align: center;
             }
             .pagination-links {
                 margin-top: 5px;
             }
             .toast-notification {
                 bottom: 1rem !important;
                 right: 1rem !important;
                 left: 1rem !important;
                 max-width: calc(100% - 2rem);
             }
        }
    </style>

    <!-- Toast Notification -->
    <div 
        x-data="{ show: {{ session('success') || session('error') ? 'true' : 'false' }}, message: '{{ session('success') ?? session('error') }}', type: '{{ session('success') ? 'success' : 'error' }}' }"
        x-show="show"
        x-init="
            if (show) {
                setTimeout(() => { show = false }, 6000);
            }
        "
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed top-24 right-6"
        style="z-index: 9999;"
    >
        @if (session('success') || session('error'))
            <div :class="type === 'success' ? 'toast-notification' : 'toast-notification error'">
                <i :class="type === 'success' ? 'fas fa-check-circle toast-icon' : 'fas fa-exclamation-circle toast-icon'" 
                   :style="type === 'success' ? 'color: #10B981;' : 'color: #EF4444;'"></i>
                <span class="toast-content">{{ session('success') ?? session('error') }}</span>
                <i class="fas fa-times toast-close" @click="show = false" title="Tutup"></i>
            </div>
        @endif
    </div>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="data-card">
                <div class="text-gray-900 dark:text-gray-100">
                    
                    <!-- Action Buttons Container -->
                    <div class="action-buttons-container"> 
                        <a href="{{ route('penduduk.create') }}" class="btn-tambah">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Data Penduduk</span>
                        </a>
                        <a href="{{ route('penduduk.export') }}" class="btn-ekspor">
                            <i class="fas fa-file-excel"></i>
                            <span>Ekspor Excel</span>
                        </a>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('penduduk.index') }}" class="flex items-center w-full md:w-1/3 mb-8">
                        <input type="text" name="search" placeholder="Cari Nama atau NIK..." 
                            value="{{ request('search') }}"
                            class="search-input"
                            aria-label="Cari data penduduk">
                        
                        <button type="submit" class="btn-cari" aria-label="Cari">
                            <i class="fas fa-search"></i>
                            <span>Cari</span>
                        </button>
                        
                        @if (request('search'))
                            <a href="{{ route('penduduk.index') }}" class="text-sm text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600 font-semibold ml-3">Reset</a>
                        @endif
                    </form>
                    
                    <div class="overflow-x-auto">
                        @if ($penduduks->count() > 0)
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center w-12">No</th>
                                        <th class="text-left">NIK / Nama</th>
                                        <th class="text-left">Wilayah</th>
                                        <th class="text-left">L/P</th>
                                        <th class="text-left">Tgl Lahir</th>
                                        <th class="text-center" style="min-width: 280px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penduduks as $index => $penduduk)
                                        <tr>
                                            <td class="whitespace-nowrap text-center">{{ $index + $penduduks->firstItem() }}</td>
                                            
                                            <td class="whitespace-nowrap">
                                                <div class="font-bold text-base text-gray-900 dark:text-gray-50 mb-1">
                                                    {{ $penduduk->nama_lengkap }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $penduduk->nik }}
                                                </div>
                                            </td>
                                            
                                            <td class="whitespace-nowrap text-gray-600 dark:text-gray-300">
                                                {{ $penduduk->wilayah->kelurahan ?? 'N/A' }} 
                                                @if ($penduduk->wilayah && $penduduk->wilayah->rw)
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                        (RW: {{ $penduduk->wilayah->rw }})
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <td class="whitespace-nowrap text-gray-600 dark:text-gray-300">
                                                {{ $penduduk->jenis_kelamin }}
                                            </td>
                                            
                                            <td class="whitespace-nowrap text-gray-600 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}
                                            </td>
                                            
                                            <td class="whitespace-nowrap text-center space-x-2">
                                                <a href="{{ route('penduduk.show', $penduduk) }}" class="action-link link-detail">
                                                    <i class="fas fa-eye"></i>Detail
                                                </a>

                                                <a href="{{ route('penduduk.edit', $penduduk) }}" class="action-link link-edit">
                                                    <i class="fas fa-edit"></i>Edit
                                                </a>

                                                <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $penduduk->nama_lengkap }}? Aksi ini tidak dapat dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-link link-hapus">
                                                        <i class="fas fa-trash-alt"></i>Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-gray-500 dark:text-gray-400 py-8">Tidak ada data penduduk yang tercatat.</p>
                        @endif
                        
                        <div class="pagination-container">
                             <div class="text-sm text-gray-700 dark:text-gray-400">
                                Showing {{ $penduduks->firstItem() }} to {{ $penduduks->lastItem() }} of {{ $penduduks->total() }} results
                            </div>
                            <div class="pagination-links">
                                {{ $penduduks->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>