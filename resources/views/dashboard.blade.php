<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pelaporan Kesehatan') }}
        </h2>
    </x-slot>

    <!-- Tambahkan Google Fonts Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS Kustom untuk Menyesuaikan dengan Welcome Page -->
    <style>
        /* Override Font Family ke Montserrat */
        body, * {
            font-family: 'Montserrat', sans-serif !important;
        }

        /* Background body yang lebih terang (sesuai welcome page) */
        body {
            background-color: #eef2f6 !important;
        }

        /* Styling untuk Card Statistik dengan border bawah colorful */
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-bottom: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 123, 255, 0.15);
        }

        /* Card Chart dengan shadow lebih halus */
        .chart-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .chart-card:hover {
            box-shadow: 0 15px 35px rgba(0, 123, 255, 0.12);
        }

        /* Section Aksi Cepat */
        .quick-action-section {
            background: linear-gradient(135deg, #f0f4ff 0%, #e0e9ff 100%);
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.08);
        }

        /* Button Aksi Cepat dengan style SehatKu */
        .action-btn {
            background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%);
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 12px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
            color: #007bff;
            font-weight: 600;
        }
        .action-btn:hover {
            background: #007bff;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }
        .action-btn svg {
            transition: all 0.3s ease;
        }
        .action-btn:hover svg {
            transform: scale(1.1);
        }

        /* Judul Section dengan garis bawah biru */
        .section-title {
            color: #007bff;
            font-weight: 700;
            font-size: 1.4em;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #007bff;
            display: inline-block;
        }

        /* Chart Title Styling */
        .chart-title {
            color: #007bff;
            font-weight: 600;
            font-size: 1.1em;
            border-bottom: 2px solid #e0e9ff;
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
        }

        /* Number styling yang lebih bold dan modern */
        .stat-number {
            font-weight: 800;
            font-size: 2.5rem;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        /* Label styling */
        .stat-label {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5a6270;
        }

        /* Dark mode adjustments */
        .dark .stat-card,
        .dark .chart-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .dark .action-btn {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            border-color: #3b82f6;
            color: #3b82f6;
        }
        .dark .action-btn:hover {
            background: #3b82f6;
            color: white;
        }

        .dark .quick-action-section {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .dark .section-title {
            color: #60a5fa;
            border-bottom-color: #3b82f6;
        }

        .dark .chart-title {
            color: #60a5fa;
            border-bottom-color: #374151;
        }

        /* Animasi untuk chart canvas */
        canvas {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h3 class="section-title">Ringkasan Data Utama</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10 mt-6">
                
                <div class="stat-card p-6" style="border-bottom-color: #007bff;">
                    <div class="stat-label text-gray-500 dark:text-gray-400">Total Penduduk</div>
                    <div class="stat-number mt-2 text-indigo-600 dark:text-indigo-400">{{ number_format($totalPenduduk) }}</div>
                </div>
                
                <div class="stat-card p-6" style="border-bottom-color: #EC4899;">
                    <div class="stat-label text-gray-500 dark:text-gray-400">Ibu Hamil Aktif</div>
                    <div class="stat-number mt-2 text-pink-600 dark:text-pink-400">{{ number_format($totalIbuHamilAktif) }}</div>
                </div>
                
                <div class="stat-card p-6" style="border-bottom-color: #EF4444;">
                    <div class="stat-label text-gray-500 dark:text-gray-400">Total Kasus Tercatat</div>
                    <div class="stat-number mt-2 text-red-600 dark:text-red-400">{{ number_format($totalRiwayatPenyakit) }}</div>
                </div>
                
                <div class="stat-card p-6" style="border-bottom-color: #10B981;">
                    <div class="stat-label text-gray-500 dark:text-gray-400">Total Kelurahan/Desa</div>
                    <div class="stat-number mt-2 text-green-600 dark:text-green-400">{{ number_format($totalWilayahTerdaftar) }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="chart-card p-6 col-span-1">
                    <h3 class="chart-title text-gray-700 dark:text-gray-200">Distribusi Jenis Kelamin</h3>
                    <canvas id="jenisKelaminChart" class="max-h-72"></canvas>
                </div>
                
                <div class="chart-card p-6 col-span-1 lg:col-span-2">
                    <h3 class="chart-title text-gray-700 dark:text-gray-200">Top 5 Kasus Penyakit (Bulan Terakhir)</h3>
                    <canvas id="topPenyakitChart" class="max-h-72"></canvas>
                    
                    @if (count($topPenyakitLabels) == 0)
                        <p class="text-center text-gray-500 mt-6">Belum ada data riwayat penyakit yang tercatat di bulan ini.</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-10 p-6 quick-action-section">
                <h3 class="section-title">Aksi Cepat Petugas</h3>
                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="{{ route('penduduk.create') }}" class="action-btn flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0z"></path></svg>
                        <span>Input Penduduk Baru</span>
                    </a>
                    
                    <a href="{{ route('laporan-kesehatan.create') }}" class="action-btn flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>Buat Laporan Kesehatan</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        // --- LOGIC CHART 1: JENIS KELAMIN ---
        const jkData = {!! json_encode($jenisKelaminData->pluck('total')) !!};
        const jkLabels = {!! json_encode($jenisKelaminData->pluck('label')) !!};

        new Chart(document.getElementById('jenisKelaminChart'), {
            type: 'pie',
            data: {
                labels: jkLabels,
                datasets: [{
                    data: jkData,
                    backgroundColor: ['#4F46E5', '#EC4899'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });

        // --- LOGIC CHART 2: TOP PENYAKIT ---
        const tpLabels = {!! json_encode($topPenyakitLabels) !!};
        const tpData = {!! json_encode($topPenyakitData) !!};

        new Chart(document.getElementById('topPenyakitChart'), {
            type: 'bar',
            data: {
                labels: tpLabels,
                datasets: [{
                    label: 'Total Kasus',
                    data: tpData,
                    backgroundColor: '#EF4444', 
                    borderColor: '#B91C1C',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { 
                    y: { beginAtZero: true } 
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</x-app-layout>