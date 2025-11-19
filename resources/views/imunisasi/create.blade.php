<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catat Imunisasi Baru') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Container Card Styling */
        .form-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px; 
            transition: all 0.3s ease;
        }

        .dark .form-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        /* Header Section */
        .form-header {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 0.75rem;
        }

        .dark .form-header {
            color: #60a5fa;
            border-bottom-color: #60a5fa;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .dark .form-label {
            color: #F3F4F6;
        }

        /* Input Styling */
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #D1D5DB;
            background-color: #ffffff;
            color: #1F2937;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .dark .form-input,
        .dark .form-select,
        .dark .form-textarea {
            background-color: #374151;
            border-color: #4B5563;
            color: #F3F4F6;
        }

        .dark .form-input:focus,
        .dark .form-select:focus,
        .dark .form-textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        /* Error Message */
        .error-message {
            font-size: 0.875rem;
            color: #DC2626;
            margin-top: 0.5rem;
        }

        .dark .error-message {
            color: #F87171;
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
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(107, 114, 128, 0.3);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(107, 114, 128, 0.4);
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #E5E7EB;
        }

        .dark .button-container {
            border-top-color: #374151;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .form-card {
                padding: 24px;
            }

            .button-container {
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
            <div class="form-card">
                
                <h3 class="form-header">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Catat Imunisasi Baru
                </h3>

                <form action="{{ route('imunisasi.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="penduduk_id" class="form-label">
                            <i class="fas fa-user mr-1"></i>
                            Pilih Penduduk
                        </label>
                        <select name="penduduk_id" id="penduduk_id" required class="form-select">
                            <option value="">-- Cari dan Pilih Penduduk --</option>
                            @foreach($penduduks as $p)
                                <option value="{{ $p->id }}" {{ old('penduduk_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_lengkap }} (NIK: {{ $p->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_imunisasi" class="form-label">
                            <i class="fas fa-shield-virus mr-1"></i>
                            Jenis Imunisasi
                        </label>
                        <select name="jenis_imunisasi" id="jenis_imunisasi" required class="form-select">
                            <option value="">-- Pilih Jenis Imunisasi --</option>
                            @foreach($jenisImunisasi as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_imunisasi') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_imunisasi')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_imunisasi" class="form-label">
                            <i class="fas fa-calendar-check mr-1"></i>
                            Tanggal Imunisasi
                        </label>
                        <input type="date" name="tanggal_imunisasi" id="tanggal_imunisasi" value="{{ old('tanggal_imunisasi') }}" required class="form-input">
                        @error('tanggal_imunisasi')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="faskes" class="form-label">
                            <i class="fas fa-hospital mr-1"></i>
                            Fasilitas/Keterangan Imunisasi
                        </label>
                        <textarea name="faskes" id="faskes" rows="3" class="form-textarea">{{ old('faskes') }}</textarea>
                        @error('faskes')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="button-container">
                        <a href="{{ route('imunisasi.index') }}" class="btn-action btn-cancel">
                            <i class="fas fa-times"></i>
                            <span>Batal</span>
                        </a>
                        <button type="submit" class="btn-action btn-submit">
                            <i class="fas fa-save"></i>
                            <span>Simpan Catatan</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>