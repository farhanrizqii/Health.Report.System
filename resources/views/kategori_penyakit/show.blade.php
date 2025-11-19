<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Kategori Penyakit') . ' - ' . $kategoriPenyakit->nama_penyakit }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Menggunakan gaya 'data-card' untuk container utama */
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

        /* Title styling */
        .detail-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 0.75rem;
        }

        .dark .detail-title {
            color: #60a5fa;
            border-bottom-color: #60a5fa;
        }

        /* Info grid styling */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .info-item {
            padding: 1rem;
            background-color: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #007bff;
        }

        .dark .info-item {
            background-color: #374151;
            border-left-color: #60a5fa;
        }

        .info-label {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .dark .info-label {
            color: #94a3b8;
        }

        .info-value {
            font-size: 1.125rem;
            font-weight: 500;
            color: #1f2937;
        }

        .dark .info-value {
            color: #f3f4f6;
        }

        .info-full-width {
            grid-column: 1 / -1;
            border-top: 2px solid #e2e8f0;
            padding-top: 1.5rem;
            margin-top: 1rem;
        }

        .dark .info-full-width {
            border-top-color: #4b5563;
        }

        /* Button styling matching index page */
        .btn-edit, .btn-kembali {
            border-radius: 10px;
            padding: 10px 20px; 
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .btn-edit {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        .btn-kembali {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(107, 114, 128, 0.3);
        }

        .btn-kembali:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(107, 114, 128, 0.4);
        }

        .button-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .button-container {
                flex-direction: column;
            }
            .btn-edit, .btn-kembali {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="data-card">
                <div class="text-gray-900 dark:text-gray-100">

                    <h3 class="detail-title">{{ $kategoriPenyakit->nama_penyakit }}</h3>

                    <div class="info-grid">
                        
                        <div class="info-item">
                            <p class="info-label">Kode ICD:</p>
                            <p class="info-value">{{ $kategoriPenyakit->kode_icd ?? '-' }}</p>
                        </div>

                        <div class="info-item">
                            <p class="info-label">ID Kategori:</p>
                            <p class="info-value">#{{ $kategoriPenyakit->id }}</p>
                        </div>
                        
                        <div class="info-item info-full-width">
                            <p class="info-label">Digunakan dalam Riwayat Kesehatan:</p>
                            <p class="info-value text-sm italic">{{ $kategoriPenyakit->riwayatKesehatan->count() }} kali</p>
                        </div>

                    </div>

                    <div class="button-container">
                        <a href="{{ route('kategori-penyakit.edit', $kategoriPenyakit) }}" class="btn-edit">
                            <i class="fas fa-edit"></i>
                            <span>Edit Data</span>
                        </a>
                        <a href="{{ route('kategori-penyakit.index') }}" class="btn-kembali">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>