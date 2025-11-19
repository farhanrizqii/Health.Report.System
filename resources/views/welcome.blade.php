<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SehatKu - Sistem Informasi Kesehatan Desa</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* ========== IMPORT FONT AWESOME ========== */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');

        /* Reset dan Box Sizing */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* FIX: Pastikan icon font menggunakan Font Awesome */
        .fa, .fas, .far, .fal, .fab {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
            font-weight: 900 !important;
        }

        /* Body & Container */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f1f5f9; 
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header (Navigasi Atas) */
        .header {
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Container Utama untuk Pemusatan */
        .container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            width: 100%;
        }
        
        /* Card Utama */
        .card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); 
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 60px;
            max-width: 1200px;
            width: 90%;
            display: flex;
            gap: 80px;
            text-align: left;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .info-section {
            flex: 1.2; 
        }
        
        .visual-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 16px;
            padding: 50px 30px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .visual-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .visual-section:hover {
            box-shadow: 0 12px 30px rgba(0, 123, 255, 0.15);
            transform: translateY(-5px);
        }

        /* ========== LOGO SEHATKU (SAMA DENGAN NAVBAR) ========== */
        .sehatku-logo {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .sehatku-logo:hover {
            transform: scale(1.05);
        }

        .sehatku-logo .icon-box {
            width: 80px;
            height: 80px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            box-shadow: 0 8px 24px rgba(0, 123, 255, 0.4);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sehatku-logo:hover .icon-box {
            box-shadow: 0 12px 32px rgba(0, 123, 255, 0.5);
            transform: rotate(5deg);
        }

        .sehatku-logo .icon-box i {
            font-size: 40px;
            color: white;
        }

        .sehatku-logo .text {
            font-size: 4em;
            font-weight: 700;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
            line-height: 1;
        }

        /* Tipografi */
        h1 {
            font-size: 3em;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        h1 .highlight {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        h2 {
            font-size: 1.5em;
            font-weight: 600;
            color: #64748b; 
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0; 
        }

        p {
            font-size: 1.1em;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        
        /* Button Container */
        .button-group {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
            align-items: center;
        }

        /* Tombol */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 35px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            min-width: 180px;
        }

        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
            transform: translateY(-3px);
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #007bff;
            border: 2px solid #007bff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            min-width: 180px;
        }

        .btn-secondary:hover {
            background-color: #f1f5f9;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
        }

        .auth-link {
            text-decoration: none;
            color: #64748b;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
            margin-right: 10px;
        }

        .auth-link:hover {
            background-color: #f1f5f9;
            color: #007bff;
        }

        /* Tagline Section */
        .tagline {
            font-size: 1.4em;
            color: #0056b3;
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50px;
            font-size: 0.95em;
            color: #475569;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1;
        }

        .security-badge i {
            color: #22c55e;
            font-size: 1.2em;
        }

        /* Responsif untuk Mobile/Tablet */
        @media (max-width: 1000px) {
            .card {
                flex-direction: column;
                padding: 40px;
                width: 95%;
                gap: 40px;
            }
            .visual-section {
                order: -1;
            }
            .info-section {
                padding-right: 0;
            }
            .container {
                overflow-y: auto;
                align-items: flex-start; 
                padding-top: 30px; 
            }
            body {
                overflow: auto; 
            }
            h1 {
                font-size: 2.2em;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            .card {
                padding: 30px;
                gap: 30px;
            }
            .sehatku-logo {
                gap: 15px;
            }
            .sehatku-logo .icon-box {
                width: 60px;
                height: 60px;
                border-radius: 14px;
            }
            .sehatku-logo .icon-box i {
                font-size: 30px;
            }
            .sehatku-logo .text {
                font-size: 2.8em;
            }
            h1 { 
                font-size: 2em; 
            }
            h2 { 
                font-size: 1.3em; 
            }
            p {
                font-size: 1em;
            }
            .btn {
                padding: 12px 24px;
                font-size: 0.95rem;
            }
            .tagline {
                font-size: 1.2em;
            }
        }

        @media (max-width: 480px) {
            .card {
                padding: 25px;
            }
            .btn {
                width: 100%;
                justify-content: center;
                margin-right: 0;
                margin-bottom: 10px;
            }
            .sehatku-logo .text {
                font-size: 2.2em;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="auth-link">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Daftar
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <div class="container">
        <div class="card">
            <div class="info-section">
                <h1>Sistem Informasi <span class="highlight">Kesehatan Desa</span></h1>
                <h2>Rekap Riwayat Kesehatan Terintegrasi</h2>
                
                <p>SehatKu memudahkan perangkat desa dan petugas kesehatan untuk merekap, mengelola, dan menganalisis riwayat kesehatan warga secara efisien dan akurat.</p>
                
                <div style="margin-top: 40px;">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-lock"></i> Masuk Sistem
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-info-circle"></i> Tentang Kami
                    </a>
                </div>
            </div>
            
            <div class="visual-section">
                
                <!-- Logo SehatKu (SAMA DENGAN NAVBAR & SIDEBAR) -->
                <div class="sehatku-logo">
                    <div class="icon-box">
                        <i class="fas fa-heartbeat"></i> 
                    </div>
                    <span class="text">SehatKu</span>
                </div>
                
                <p class="tagline">
                    "Data Tepat, <br>Layanan Kesehatan Berdampak."
                </p>
                
                <div class="security-badge">
                    <i class="fas fa-shield-check"></i>
                    <span>Keamanan Data Terjamin</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>