<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pelaporan Kesehatan') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-300">Ringkasan Data Utama</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-indigo-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Penduduk</div>
                    <div class="mt-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ number_format($totalPenduduk) }}</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-pink-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Ibu Hamil Aktif</div>
                    <div class="mt-1 text-4xl font-extrabold text-pink-600 dark:text-pink-400">{{ number_format($totalIbuHamilAktif) }}</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-red-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kasus Tercatat</div>
                    <div class="mt-1 text-4xl font-extrabold text-red-600 dark:text-red-400">{{ number_format($totalRiwayatPenyakit) }}</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kelurahan/Desa</div>
                    <div class="mt-1 text-4xl font-extrabold text-green-600 dark:text-green-400">{{ number_format($totalWilayahTerdaftar) }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg col-span-1">
                    <h3 class="text-lg font-semibold border-b pb-3 mb-4 text-gray-700 dark:border-gray-700 dark:text-gray-200">Distribusi Jenis Kelamin</h3>
                    <canvas id="jenisKelaminChart" class="max-h-72"></canvas>
                </div>
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg col-span-1 lg:col-span-2">
                    <h3 class="text-lg font-semibold border-b pb-3 mb-4 text-gray-700 dark:border-gray-700 dark:text-gray-200">Top 5 Kasus Penyakit (Bulan Terakhir)</h3>
                    <canvas id="topPenyakitChart" class="max-h-72"></canvas>
                    
                    @if (count($topPenyakitLabels) == 0)
                        <p class="text-center text-gray-500 mt-6">Belum ada data riwayat penyakit yang tercatat di bulan ini.</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-10 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner">
                <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-300">Aksi Cepat Petugas</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('penduduk.create') }}" class="flex items-center space-x-2 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-md text-gray-700 dark:text-gray-200 transition duration-150">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0z"></path></svg>
                        <span>Input Penduduk Baru</span>
                    </a>
                    
                    <a href="{{ route('laporan-kesehatan.create') }}" class="flex items-center space-x-2 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-md text-gray-700 dark:text-gray-200 transition duration-150">
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
                    legend: { display: false } // Sembunyikan legenda di bar chart
                }
            }
        });
    </script>
</x-app-layout>