<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - SehatKu</title>

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

        /* Card Lupa Password (Dikecilkan, mirip dengan card login) */
        .password-reset-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%); 
            border-radius: 14px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05);
            padding: 30px;
            max-width: 400px; /* Lebar maksimum yang ringkas */
            width: 90%;
            text-align: center;
        }
        
        /* Judul/Logo di Atas Form */
        .header-reset {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header-reset .logo-icon {
            font-size: 3.5em;
            color: #007bff; /* Warna biru SehatKu */
            margin-bottom: 8px;
        }
        .header-reset .title {
            font-size: 1.6em;
            font-weight: 700;
            color: #333;
        }
        .header-reset .description {
            font-size: 0.9em;
            color: #5a6270;
            line-height: 1.5;
            margin-top: 15px; /* Jarak deskripsi dari ikon/judul */
        }

        /* Styling Form */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #5a6270;
            font-size: 0.85em;
        }
        .form-group input[type="email"] {
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

        /* Tombol Kirim Link */
        .btn-reset {
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
            width: 100%; /* Tombol Full Width */
            font-size: 0.9em;
            margin-top: 10px;
        }
        .btn-reset:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        
        /* Link Kembali ke Login */
        .back-to-login {
            font-size: 0.85em;
            color: #5a6270;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            transition: color 0.3s;
        }
        .back-to-login:hover {
            color: #007bff;
        }

        /* Pesan Status */
        .status-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            font-size: 0.9em;
            text-align: left;
        }
        .error-message {
            font-size: 0.75em;
            color: #dc3545;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    {{-- Status Sesi (Menggantikan <x-auth-session-status>) --}}
    @if (session('status'))
        <div class="password-reset-card status-message">
            {{ session('status') }}
        </div>
    @endif

    <div class="password-reset-card">
        <div class="header-reset">
            <i class="fas fa-key logo-icon"></i> 
            <span class="title">Lupa Password Anda?</span>
            <p class="description">Jangan khawatir. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan reset password kepada Anda.</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email Address --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn-reset">
                <i class="fas fa-envelope"></i> Kirim Tautan Reset
            </button>
        </form>

        <a class="back-to-login" href="{{ route('login') }}">
            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Login
        </a>
    </div>
</body>
</html>