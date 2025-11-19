<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Fasilitas Kesehatan') . ' - ' . $fasilitasKesehatan->nama_faskes }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Data card styling */
        .data-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px; 
            transition: all 0.3s ease;
        }

        .dark .data-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        /* Header section */
        .detail-header {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dark .detail-header {
            color: #60a5fa;
            border-bottom-color: #60a5fa;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            background: rgba(0, 123, 255, 0.05);
            padding: 1.25rem;
            border-radius: 12px;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }

        .dark .info-item {
            background: rgba(96, 165, 250, 0.1);
            border-left-color: #60a5fa;
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
        }

        .info-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dark .info-label {
            color: #94a3b8;
        }

        .info-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
        }

        .dark .info-value {
            color: #f1f5f9;
        }

        /* Full width section for address */
        .info-full {
            grid-column: 1 / -1;
            background: rgba(16, 185, 129, 0.05);
            border-left-color: #10B981;
        }

        .dark .info-full {
            background: rgba(52, 211, 153, 0.1);
            border-left-color: #34D399;
        }

        /* Buttons */
        .btn-action {
            border-radius: 10px;
            padding: 12px 24px; 
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

        .btn-back {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(107, 114, 128, 0.3);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(107, 114, 128, 0.4);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e2e8f0;
            flex-wrap: wrap;
        }

        .dark .action-buttons {
            border-top-color: #334155;
        }

        /* Badge for ID */
        .id-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .data-card {
                padding: 24px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="data-card">

                <h3 class="detail-header">
                    <i class="fas fa-hospital"></i>
                    Informasi Fasilitas
                </h3>

                <div class="info-grid">
                    
                    <div class="info-item">
                        <p class="info-label">
                            <i class="fas fa-building"></i>
                            Nama Fasilitas
                        </p>
                        <p class="info-value">{{ $fasilitasKesehatan->nama_faskes }}</p>
                    </div>

                    <div class="info-item">
                        <p class="info-label">
                            <i class="fas fa-clipboard-list"></i>
                            Jenis
                        </p>
                        <p class="info-value">{{ $fasilitasKesehatan->jenis_faskes }}</p>
                    </div>

                    <div class="info-item">
                        <p class="info-label">
                            <i class="fas fa-phone"></i>
                            Kontak (Telepon)
                        </p>
                        <p class="info-value">{{ $fasilitasKesehatan->kontak ?? '-' }}</p>
                    </div>

                    <div class="info-item">
                        <p class="info-label">
                            <i class="fas fa-hashtag"></i>
                            ID Pencatatan
                        </p>
                        <p class="info-value">
                            <span class="id-badge">#{{ $fasilitasKesehatan->id }}</span>
                        </p>
                    </div>

                    <div class="info-item info-full">
                        <p class="info-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Alamat Lengkap
                        </p>
                        <p class="info-value">{{ $fasilitasKesehatan->alamat }}</p>
                    </div>

                </div>

                <div class="action-buttons">
                    <a href="{{ route('fasilitas-kesehatan.edit', $fasilitasKesehatan) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit Data
                    </a>
                    <a href="{{ route('fasilitas-kesehatan.index') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>