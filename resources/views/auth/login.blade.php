<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SehatKu</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Mengadopsi style dari welcome.blade.php */
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
            flex-direction: column; /* Ditambah untuk menampung alert di atas card */
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
        }

        /* Styling Pesan Status Sukses (Biru SehatKu) */
        .alert-success {
            background-color: #d8eaff; /* Biru terang dari visual-section */
            color: #0056b3; /* Biru tua untuk teks */
            padding: 15px 20px;
            margin-bottom: 25px;
            border: 1px solid #007bff; 
            border-radius: 8px;
            font-weight: 600;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2);
            max-width: 400px; /* Lebar sesuai card */
            width: 90%;
        }

        /* Card Login Baru */
        .login-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%); 
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05);
            padding: 30px;
            max-width: 400px; 
            width: 90%;
            text-align: center;
        }
        
        /* Judul/Logo di Atas Form */
        .header-login {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header-login .logo-icon {
            font-size: 3.5em; /* Dikecilkan */
            color: #007bff; 
            margin-bottom: 8px;
        }
        .header-login .title {
            font-size: 1.6em; /* Dikecilkan */
            font-weight: 700;
            color: #333;
        }
        .header-login .subtitle {
            font-size: 0.85em; /* Dikecilkan */
            color: #5a6270;
            margin-top: 5px;
        }
        
        /* Input Styling */
        .form-group {
            margin-bottom: 15px; 
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #5a6270;
            font-size: 0.85em;
        }
        .form-group input[type="email"],
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

        /* Checkbox Remember Me dan Lupa Password */
        .remember-me {
            display: flex;
            align-items: center;
        }
        .remember-me label {
            font-size: 0.9em;
            color: #5a6270;
            font-weight: 500;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
        }
        
        /* Tombol Login */
        .btn-login {
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
            width: 120px; 
            font-size: 0.9em;
        }
        .btn-login:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        
        /* Link Lupa Password */
        .forgot-password {
            font-size: 0.85em;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .forgot-password:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .error-message {
            font-size: 0.75em;
            color: #dc3545;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    
    {{-- TAMPILAN PESAN STATUS SUKSES (setelah registrasi) --}}
    @if (session('status'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
        </div>
    @endif

    <div class="login-card">
        <div class="header-login">
            <i class="fas fa-chart-area logo-icon"></i> 
            <span class="title">Masuk ke SehatKu</span>
            <span class="subtitle">Sistem Informasi Kesehatan Desa</span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="form-actions">
                <div class="remember-me">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>
            
            @if (Route::has('password.request'))
                <div style="text-align: right; margin-top: 15px;">
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Lupa Password Anda?
                    </a>
                </div>
            @endif
        </form>
    </div>
</body>
</html>