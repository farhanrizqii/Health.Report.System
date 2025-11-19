<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Catatan Ibu Hamil') . ' - ' . $ibuHamil->penduduk->nama_lengkap }}
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

        /* Section Title */
        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1F2937;
            border-bottom: 2px solid #E5E7EB;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .dark .section-title {
            color: #F3F4F6;
            border-bottom-color: #4B5563;
        }

        /* Detail Item */
        .detail-item {
            padding: 0.75rem 0;
            color: #475569;
            line-height: 1.6;
        }

        .dark .detail-item {
            color: #CBD5E1;
        }

        .detail-label {
            font-weight: 600;
            color: #1F2937;
            display: inline-block;
            min-width: 180px;
        }

        .dark .detail-label {
            color: #F3F4F6;
        }

        .detail-value {
            color: #475569;
        }

        .dark .detail-value {
            color: #94A3B8;
        }

        .detail-value-highlight {
            font-weight: 700;
            color: #EC4899;
        }

        .dark .detail-value-highlight {
            color: #F472B6;
        }

        .detail-value-risk {
            font-weight: 700;
            color: #DC2626;
        }

        .dark .detail-value-risk {
            color: #EF4444;
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

            .detail-label {
                min-width: 100%;
                display: block;
                margin-bottom: 0.25rem;
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="detail-card">
                
                <h3 class="detail-header">
                    <i class="fas fa-user-nurse mr-2"></i>
                    Data Ibu & Kehamilan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- Kolom Kiri: Data Ibu --}}
                    <div class="space-y-1">
                        <p class="section-title">Data Ibu</p>
                        
                        <div class="detail-item">
                            <span class="detail-label">Nama:</span>
                            <span class="detail-value">{{ $ibuHamil->penduduk->nama_lengkap ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">NIK:</span>
                            <span class="detail-value">{{ $ibuHamil->penduduk->nik ?? '-' }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Gol. Darah:</span>
                            <span class="detail-value">{{ $ibuHamil->golongan_darah ?? '-' }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Tinggi Badan:</span>
                            <span class="detail-value">{{ $ibuHamil->tinggi_badan ? $ibuHamil->tinggi_badan . ' cm' : '-' }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Berat Badan:</span>
                            <span class="detail-value">{{ $ibuHamil->berat_badan ? $ibuHamil->berat_badan . ' kg' : '-' }}</span>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Data Kehamilan --}}
                    <div class="space-y-1">
                        <p class="section-title">Data Kehamilan</p>
                        
                        <div class="detail-item">
                            <span class="detail-label">Tgl. Mulai Hamil:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($ibuHamil->tanggal_mulai_hamil)->format('d F Y') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Usia Kehamilan:</span>
                            <span class="detail-value">{{ $ibuHamil->usia_kehamilan_minggu }} minggu</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">TPL (Perkiraan Lahir):</span>
                            <span class="detail-value-highlight">{{ \Carbon\Carbon::parse($ibuHamil->tanggal_perkiraan_lahir)->format('d F Y') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Risiko:</span>
                            <span class="detail-value-risk">{{ $ibuHamil->risiko_kehamilan ?? 'N/A' }}</span>
                        </div>
                    </div>

                </div>

                {{-- Footer dengan keterangan tambahan --}}
                <div class="detail-footer md:col-span-2">
                    <p class="footer-label">Keterangan Tambahan:</p>
                    <p class="detail-value">{{ $ibuHamil->keterangan_lain ?? '-' }}</p>
                </div>

                {{-- Action Buttons --}}
                <div class="button-container">
                    <a href="{{ route('ibuhamil.edit', $ibuHamil) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        <span>Edit Data</span>
                    </a>
                    
                    <a href="{{ route('ibuhamil.index') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>