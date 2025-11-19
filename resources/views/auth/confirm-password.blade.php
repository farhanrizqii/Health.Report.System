<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Password - SehatKu</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Menggunakan style dasar yang konsisten */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #eef2f6; /* Warna background yang konsisten */
            color: #333;
            display: flex;
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
        }

        /* Card Konfirmasi Password (Sangat ringkas) */
        .confirm-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%); 
            border-radius: 14px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05);
            padding: 30px;
            max-width: 400px; /* Lebar maksimum yang ringkas */
            width: 90%;
            text-align: center;
        }
        
        /* Header dan Deskripsi */
        .header-confirm {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header-confirm .logo-icon {
            font-size: 3.5em;
            color: #007bff; /* Warna biru SehatKu */
            margin-bottom: 8px;
        }
        .header-confirm .description {
            font-size: 0.9em;
            color: #5a6270;
            line-height: 1.5;
            margin-top: 15px;
            text-align: left; /* Teks deskripsi rata kiri */
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Styling Form */
        .form-group {
            margin-top: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #5a6270;
            font-size: 0.85em;
        }
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #c9d2db;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #007bff; 
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        /* Aksi Form */
        .form-actions {
            display: flex;
            justify-content: flex-end; /* Pindahkan tombol ke kanan */
            margin-top: 20px;
        }
        
        /* Tombol Konfirmasi */
        .btn-confirm {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 150px; 
            font-size: 0.9em;
        }
        .btn-confirm:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }

        .error-message {
            font-size: 0.75em;
            color: #dc3545;
            margin-top: 3px;
            text-align: left;
        }
    </style>
</head>
<body>
    {{-- Status Sesi (Opsional) --}}
    @if (session('status'))
        <div class="confirm-card status-message">
            {{ session('status') }}
        </div>
    @endif

    <div class="confirm-card">
        <div class="header-confirm">
            <i class="fas fa-lock logo-icon"></i> 
            <p class="description">
                Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="form-actions">
                <button type="submit" class="btn-confirm">
                    <i class="fas fa-check-circle"></i> Konfirmasi
                </button>
            </div>
        </form>
    </div>
</body>
</html>