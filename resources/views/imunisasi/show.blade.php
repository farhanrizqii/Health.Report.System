<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Catatan Imunisasi') . ' - ' . $imunisasi->penduduk->nama_lengkap }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Container Card Styling */
        .detail-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px; 
            transition: all 0.3s ease;
        }

        .dark .detail-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        /* Header Section */
        .detail-header {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 0.75rem;
        }

        .dark .detail-header {
            color: #60a5fa;
            border-bottom-color: #60a5fa;
        }

        /* Detail Item */
        .detail-item {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            font-weight: 600;
            color: #1F2937;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .dark .detail-label {
            color: #F3F4F6;
        }

        .detail-value {
            color: #475569;
            font-size: 0.9375rem;
        }

        .dark .detail-value {
            color: #94A3B8;
        }

        .detail-value-highlight {
            font-weight: 700;
            font-size: 1.125rem;
            color: #007bff;
        }

        .dark .detail-value-highlight {
            color: #60a5fa;
        }

        /* Footer Section */
        .detail-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #E5E7EB;
        }

        .dark .detail-footer {
            border-top-color: #374151;
        }

        .footer-label {
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .dark .footer-label {
            color: #F3F4F6;
        }

        /* Action Buttons */
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
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(107, 114, 128, 0.3);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(107, 114, 128, 0.4);
        }

        .button-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .detail-card {
                padding: 24px;
            }

            .button-container {
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
            <div class="detail-card">
                
                <h3 class="detail-header">
                    <i class="fas fa-syringe mr-2"></i>
                    Informasi Imunisasi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="detail-item">
                        <p class="detail-label">
                            <i class="fas fa-user mr-1"></i>
                            Nama Penduduk:
                        </p>
                        <p class="detail-value">{{ $imunisasi->penduduk->nama_lengkap ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="detail-item">
                        <p class="detail-label">
                            <i class="fas fa-id-card mr-1"></i>
                            NIK:
                        </p>
                        <p class="detail-value">{{ $imunisasi->penduduk->nik ?? '-' }}</p>
                    </div>
                    
                    <div class="detail-item">
                        <p class="detail-label">
                            <i class="fas fa-shield-virus mr-1"></i>
                            Jenis Imunisasi:
                        </p>
                        <p class="detail-value-highlight">{{ $imunisasi->jenis_imunisasi }}</p>
                    </div>
                    
                    <div class="detail-item">
                        <p class="detail-label">
                            <i class="fas fa-calendar-check mr-1"></i>
                            Tanggal Pemberian:
                        </p>
                        <p class="detail-value">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d F Y') }}</p>
                    </div>

                </div>

                {{-- Footer dengan keterangan fasilitas --}}
                <div class="detail-footer">
                    <p class="footer-label">
                        <i class="fas fa-hospital mr-1"></i>
                        Fasilitas/Keterangan:
                    </p>
                    <p class="detail-value">{{ $imunisasi->faskes ?? '— Tidak ada keterangan faskes tercatat —' }}</p>
                </div>

                {{-- Action Buttons --}}
                <div class="button-container">
                    <a href="{{ route('imunisasi.edit', $imunisasi) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        <span>Edit Data</span>
                    </a>
                    
                    <a href="{{ route('imunisasi.index') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>