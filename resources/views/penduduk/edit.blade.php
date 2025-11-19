<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Penduduk') . ' - ' . $penduduk->nama_lengkap }}
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

        /* Radio Button Group */
        .radio-group {
            display: flex;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }

        .radio-label {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .radio-input {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            cursor: pointer;
            accent-color: #007bff;
        }

        .radio-text {
            font-size: 0.9375rem;
            color: #475569;
        }

        .dark .radio-text {
            color: #CBD5E1;
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

            .radio-group {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">
                
                <h3 class="form-header">
                    <i class="fas fa-user-edit mr-2"></i>
                    Edit Data Penduduk
                </h3>

                <form action="{{ route('penduduk.update', $penduduk) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="wilayah_id" class="form-label">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Wilayah (Kelurahan/Desa)
                        </label>
                        <select name="wilayah_id" id="wilayah_id" required class="form-select">
                            <option value="">-- Pilih Wilayah --</option>
                            @foreach($wilayahs as $wilayah)
                                <option 
                                    value="{{ $wilayah->id }}" 
                                    {{ old('wilayah_id', $penduduk->wilayah_id) == $wilayah->id ? 'selected' : '' }}
                                >
                                    {{ $wilayah->kelurahan }} 
                                </option>
                            @endforeach
                        </select>
                        @error('wilayah_id')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nik" class="form-label">
                            <i class="fas fa-id-card mr-1"></i>
                            Nomor Induk Kependudukan (NIK)
                        </label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik', $penduduk->nik) }}" required maxlength="16" class="form-input">
                        @error('nik')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">
                            <i class="fas fa-user mr-1"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required class="form-input">
                        @error('nama_lengkap')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">
                            <i class="fas fa-calendar mr-1"></i>
                            Tanggal Lahir
                        </label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" required class="form-input">
                        @error('tanggal_lahir')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-venus-mars mr-1"></i>
                            Jenis Kelamin
                        </label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'checked' : '' }} required class="radio-input">
                                <span class="radio-text">Laki-laki</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'checked' : '' }} required class="radio-input">
                                <span class="radio-text">Perempuan</span>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-home mr-1"></i>
                            Alamat Lengkap
                        </label>
                        <textarea name="alamat" id="alamat" rows="3" required class="form-textarea">{{ old('alamat', $penduduk->alamat) }}</textarea>
                        @error('alamat')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="golongan_darah" class="form-label">
                            <i class="fas fa-tint mr-1"></i>
                            Golongan Darah (Opsional)
                        </label>
                        <select name="golongan_darah" id="golongan_darah" class="form-select">
                            @php
                                $golDarahOptions = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];
                            @endphp
                            <option value="">-- Pilih Golongan Darah --</option>
                            @foreach($golDarahOptions as $option)
                                <option value="{{ $option }}" {{ old('golongan_darah', $penduduk->golongan_darah) == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        @error('golongan_darah')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp" class="form-label">
                            <i class="fas fa-phone mr-1"></i>
                            Nomor HP (Opsional)
                        </label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $penduduk->no_hp) }}" maxlength="15" class="form-input">
                        @error('no_hp')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="no_kk" class="form-label">
                            <i class="fas fa-id-card-alt mr-1"></i>
                            Nomor KK (Opsional)
                        </label>
                        <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $penduduk->no_kk) }}" maxlength="20" class="form-input">
                        @error('no_kk')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="button-container">
                        <a href="{{ route('penduduk.index') }}" class="btn-action btn-cancel">
                            <i class="fas fa-times"></i>
                            <span>Batal</span>
                        </a>
                        <button type="submit" class="btn-action btn-submit">
                            <i class="fas fa-save"></i>
                            <span>Perbarui Data</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>