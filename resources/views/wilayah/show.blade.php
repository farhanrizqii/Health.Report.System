<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Wilayah') . ' - ' . $wilayah->kelurahan }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Data Card - Konsisten dengan index */
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

        /* Detail Content */
        .detail-content {
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .dark .detail-content {
            background: #1f2937;
        }

        /* Title dengan icon */
        .detail-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #007bff;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dark .detail-title {
            color: #F3F4F6;
            border-bottom-color: #60a5fa;
        }

        .title-icon {
            color: #007bff;
            font-size: 1.5rem;
        }

        .dark .title-icon {
            color: #60a5fa;
        }

        /* Detail Info Items */
        .detail-info {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            margin-bottom: 2rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 16px;
            background-color: #F9FAFB;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            transition: all 0.2s ease;
        }

        .detail-item:hover {
            background-color: #EFF6FF;
            transform: translateX(4px);
        }

        .dark .detail-item {
            background-color: #374151;
            border-left-color: #60a5fa;
        }

        .dark .detail-item:hover {
            background-color: #1e3a8a;
        }

        .detail-label {
            font-weight: 700;
            color: #6B7280;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dark .detail-label {
            color: #9CA3AF;
        }

        .detail-value {
            font-size: 1.125rem;
            color: #1F2937;
            font-weight: 600;
        }

        .dark .detail-value {
            color: #F3F4F6;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        /* Buttons - Konsisten dengan index */
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

        /* Button Container */
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 1rem;
            border-top: 2px solid #E5E7EB;
        }

        .dark .action-buttons {
            border-top-color: #4B5563;
        }

        /* Parent ID Info */
        .parent-info {
            background-color: #FEF3C7;
            border: 2px solid #F59E0B;
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #92400E;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dark .parent-info {
            background-color: #451a03;
            border-color: #F59E0B;
            color: #FCD34D;
        }

        .parent-icon {
            font-size: 1.1rem;
            color: #F59E0B;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .detail-content {
                padding: 20px;
            }

            .detail-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .detail-item {
                padding: 12px;
            }
        }
    </style>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="data-card">
                <div class="detail-content">
                    <h3 class="detail-title">
                        <i class="fas fa-map-marker-alt title-icon"></i>
                        <span>{{ $wilayah->kelurahan }}</span>
                    </h3>
                    
                    <div class="detail-info">
                        <div class="detail-item">
                            <span class="detail-label">
                                <i class="fas fa-info-circle mr-1"></i>
                                Status Wilayah
                            </span>
                            <span class="detail-value">
                                <span class="status-badge">
                                    {{ $wilayah->parent_id ? 'Tingkat RT/RW' : 'Tingkat Kelurahan/Desa' }}
                                </span>
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">
                                <i class="fas fa-home mr-1"></i>
                                RW
                            </span>
                            <span class="detail-value">{{ $wilayah->rw ?? '-' }}</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">
                                <i class="fas fa-building mr-1"></i>
                                RT
                            </span>
                            <span class="detail-value">{{ $wilayah->rt ?? '-' }}</span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Dibuat Pada
                            </span>
                            <span class="detail-value">{{ $wilayah->created_at->format('d F Y, H:i') }}</span>
                        </div>
                        
                        @if ($wilayah->parent_id)
                            <div class="parent-info">
                                <i class="fas fa-link parent-icon"></i>
                                <span><strong>Wilayah Induk ID:</strong> {{ $wilayah->parent_id }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('wilayah.edit', $wilayah) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                            <span>Edit Data</span>
                        </a>
                        <a href="{{ route('wilayah.index') }}" class="btn-action btn-back">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>