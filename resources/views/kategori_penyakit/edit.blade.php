<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori Penyakit') . ' - ' . $kategoriPenyakit->nama_penyakit }}
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

        /* Form groups */
        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dark .form-label {
            color: #94a3b8;
        }

        .form-label i {
            color: #007bff;
            font-size: 1rem;
        }

        .dark .form-label i {
            color: #60a5fa;
        }

        /* Input styling */
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            background: white;
            color: #1e293b;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .dark .form-input {
            background: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }

        .dark .form-input:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        /* Error messages */
        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .dark .error-message {
            color: #f87171;
        }

        /* Required indicator */
        .required {
            color: #dc2626;
            margin-left: 2px;
        }

        /* Optional tag */
        .optional-tag {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 400;
            text-transform: none;
            margin-left: 4px;
        }

        .dark .optional-tag {
            color: #94a3b8;
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
            border: none;
            cursor: pointer;
        }

        .btn-submit {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(107, 114, 128, 0.3);
            text-decoration: none;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(107, 114, 128, 0.4);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 2px solid #e2e8f0;
            flex-wrap: wrap;
        }

        .dark .action-buttons {
            border-top-color: #334155;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .data-card {
                padding: 24px;
            }
            
            .action-buttons {
                flex-direction: column-reverse;
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
                    <i class="fas fa-edit"></i>
                    Edit Data Kategori
                </h3>

                <form action="{{ route('kategori-penyakit.update', $kategoriPenyakit) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_penyakit" class="form-label">
                            <i class="fas fa-virus"></i>
                            Nama Penyakit
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nama_penyakit" 
                            id="nama_penyakit" 
                            value="{{ old('nama_penyakit', $kategoriPenyakit->nama_penyakit) }}" 
                            required 
                            class="form-input"
                            placeholder="Masukkan nama penyakit">
                        @error('nama_penyakit')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_icd" class="form-label">
                            <i class="fas fa-code"></i>
                            Kode ICD
                            <span class="optional-tag">(Opsional)</span>
                        </label>
                        <input 
                            type="text" 
                            name="kode_icd" 
                            id="kode_icd" 
                            value="{{ old('kode_icd', $kategoriPenyakit->kode_icd) }}" 
                            class="form-input"
                            placeholder="Masukkan kode ICD">
                        @error('kode_icd')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('kategori-penyakit.index') }}" class="btn-action btn-cancel">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-action btn-submit">
                            <i class="fas fa-save"></i>
                            Perbarui Kategori
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>