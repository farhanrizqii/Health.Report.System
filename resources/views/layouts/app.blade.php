<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ========== IMPORT FONT AWESOME FIRST ========== */
            @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');

            /* ========== GLOBAL FONT ========== */
            * {
                font-family: 'Montserrat', sans-serif !important;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            
            /* FIX: Icon font harus menggunakan Font Awesome */
            .fa, .fas, .far, .fal, .fab {
                font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
                font-weight: 900 !important;
            }

            /* ========== BODY & BACKGROUND ========== */
            body {
                background-color: #f1f5f9 !important;
                color: #1e293b;
            }

            .dark body {
                background-color: #0f172a !important;
                color: #e2e8f0;
            }

            /* Main Container */
            .min-h-screen {
                background-color: #f1f5f9;
                min-height: 100vh;
            }

            .dark .min-h-screen {
                background-color: #0f172a;
            }

            /* ========== HEADER STYLING ========== */
            header.bg-white {
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02);
                border-bottom: 1px solid #e2e8f0;
                padding: 1.5rem 0;
            }

            .dark header.bg-white {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
                border-bottom-color: #334155;
            }

            /* Header Title */
            header h2 {
                color: #1e293b;
                font-weight: 700;
                letter-spacing: -0.5px;
                font-size: 1.875rem;
                margin: 0;
            }

            .dark header h2 {
                color: #f1f5f9;
            }

            /* ========== MAIN CONTENT AREA ========== */
            main {
                padding: 1.5rem 0;
                min-height: calc(100vh - 128px);
            }

            /* Content Container */
            .content-container {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02);
                padding: 2rem;
                margin-bottom: 1.5rem;
            }

            .dark .content-container {
                background: #1e293b;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            }

            /* ========== RESPONSIVE ADJUSTMENTS ========== */
            @media (max-width: 640px) {
                header h2 {
                    font-size: 1.5rem;
                }

                .content-container {
                    padding: 1.25rem;
                }

                main {
                    padding: 1rem 0;
                }
            }

            /* ========== SMOOTH SCROLLING ========== */
            html {
                scroll-behavior: smooth;
            }

            /* ========== CUSTOM SCROLLBAR ========== */
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f5f9;
            }

            .dark ::-webkit-scrollbar-track {
                background: #1e293b;
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 5px;
            }

            .dark ::-webkit-scrollbar-thumb {
                background: #475569;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .dark ::-webkit-scrollbar-thumb:hover {
                background: #64748b;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page Header -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Main Content -->
            <main>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>