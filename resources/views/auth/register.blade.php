<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SehatKu</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Mengadopsi style dasar dari welcome dan login page */
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
            background-color: #eef2f6; 
            color: #333;
            display: flex;
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
        }

        /* Card Registrasi: Dikecilkan dari 450px menjadi 400px, padding dikurangi */
        .register-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%); 
            border-radius: 14px; /* Radius dikurangi sedikit */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05);
            padding: 30px; /* Padding dikurangi (sebelumnya 40px) */
            max-width: 400px; /* Lebar maksimum dikurangi (sebelumnya 450px) */
            width: 90%;
            text-align: center;
        }
        
        /* Judul/Logo di Atas Form: Margin dan Ukuran Ikon/Font dikurangi */
        .header-register {
            margin-bottom: 25px; /* Margin dikurangi */
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header-register .logo-icon {
            font-size: 3.5em; /* Ukuran ikon dikurangi (sebelumnya 4em) */
            color: #007bff; 
            margin-bottom: 8px; /* Margin dikurangi */
        }
        .header-register .title {
            font-size: 1.6em; /* Ukuran judul dikurangi (sebelumnya 1.8em) */
            font-weight: 700;
            color: #333;
        }
        .header-register .subtitle {
            font-size: 0.85em; /* Ukuran subtitle dikurangi */
            color: #5a6270;
            margin-top: 5px;
        }
        
        /* Input Styling: Padding Input dikurangi */
        .form-group {
            margin-bottom: 15px; /* Margin antar grup dikurangi (sebelumnya 20px) */
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px; /* Margin label dikurangi */
            font-weight: 600;
            color: #5a6270;
            font-size: 0.85em; /* Ukuran font label dikurangi */
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 12px; /* Padding input dikurangi (sebelumnya 12px 15px) */
            border: 1px solid #c9d2db;
            border-radius: 6px; /* Radius dikurangi */
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95em; /* Ukuran font input dikurangi */
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #007bff; 
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        /* Tombol & Aksi Form: Margin Tombol dikurangi */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px; /* Margin atas dikurangi (sebelumnya 30px) */
        }
        
        /* Tombol Register: Padding dan lebar dikurangi */
        .btn-register {
            background-color: #007bff;
            color: white;
            padding: 10px 20px; /* Padding dikurangi (sebelumnya 12px 25px) */
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 120px; /* Lebar tombol dikurangi (sebelumnya 150px) */
            font-size: 0.9em;
        }
        .btn-register:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        
        /* Link Sudah Terdaftar? */
        .already-registered {
            font-size: 0.85em; /* Ukuran font dikurangi */
            color: #5a6270;
            text-decoration: none;
        }
        .already-registered:hover {
            color: #007bff;
        }
        
        .error-message {
            font-size: 0.75em;
            color: #dc3545;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="header-register">
            <i class="fas fa-user-plus logo-icon"></i> 
            <span class="title">Daftar Akun Baru</span>
            <span class="subtitle">Mulai kelola data kesehatan desa Anda</span>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Address --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a class="already-registered" href="{{ route('login') }}">
                    Sudah terdaftar?
                </a>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </div>
        </form>
    </div>
</body>
</html>