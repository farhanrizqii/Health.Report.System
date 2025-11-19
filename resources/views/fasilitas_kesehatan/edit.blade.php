<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Fasilitas Kesehatan') . ' - ' . $fasilitasKesehatan->nama_faskes }}
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
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            background: white;
            color: #1e293b;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .dark .form-input, .dark .form-select, .dark .form-textarea {
            background: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }

        .dark .form-input:focus, .dark .form-select:focus, .dark .form-textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
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
                    Edit Data Fasilitas
                </h3>

                <form action="{{ route('fasilitas-kesehatan.update', $fasilitasKesehatan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_faskes" class="form-label">
                            <i class="fas fa-building"></i>
                            Nama Fasilitas
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nama_faskes" 
                            id="nama_faskes" 
                            value="{{ old('nama_faskes', $fasilitasKesehatan->nama_faskes) }}" 
                            required 
                            class="form-input"
                            placeholder="Masukkan nama fasilitas kesehatan">
                        @error('nama_faskes')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_faskes" class="form-label">
                            <i class="fas fa-clipboard-list"></i>
                            Jenis Fasilitas
                            <span class="required">*</span>
                        </label>
                        <select 
                            name="jenis_faskes" 
                            id="jenis_faskes" 
                            required 
                            class="form-select">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach(['Puskesmas', 'Posyandu', 'Klinik', 'Lainnya'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_faskes', $fasilitasKesehatan->jenis_faskes) == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_faskes')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Alamat Lengkap
                            <span class="required">*</span>
                        </label>
                        <textarea 
                            name="alamat" 
                            id="alamat" 
                            rows="4" 
                            required 
                            class="form-textarea"
                            placeholder="Masukkan alamat lengkap fasilitas kesehatan">{{ old('alamat', $fasilitasKesehatan->alamat) }}</textarea>
                        @error('alamat')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kontak" class="form-label">
                            <i class="fas fa-phone"></i>
                            Nomor Telepon
                            <span class="optional-tag">(Opsional)</span>
                        </label>
                        <input 
                            type="text" 
                            name="kontak" 
                            id="kontak" 
                            value="{{ old('kontak', $fasilitasKesehatan->kontak) }}" 
                            class="form-input"
                            placeholder="Contoh: 0821-xxxx-xxxx">
                        @error('kontak')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('fasilitas-kesehatan.index') }}" class="btn-action btn-cancel">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-action btn-submit">
                            <i class="fas fa-save"></i>
                            Perbarui Fasilitas
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>