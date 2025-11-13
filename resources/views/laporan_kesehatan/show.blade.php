<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Laporan Kesehatan') . ' - ' . \Carbon\Carbon::parse($laporanKesehatan->tanggal_laporan)->format('d/m/Y') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-8 p-4 border rounded-lg dark:border-gray-700">
                        <h3 class="text-xl font-bold mb-4 text-indigo-600 dark:text-indigo-400">Ringkasan Laporan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <p><strong>Tanggal Laporan:</strong> {{ \Carbon\Carbon::parse($laporanKesehatan->tanggal_laporan)->format('d F Y') }}</p>
                            <p><strong>Fasilitas Pencatat:</strong> {{ $laporanKesehatan->fasilitas->nama_fasilitas ?? 'N/A' }}</p>
                            <p><strong>Jenis Kegiatan:</strong> {{ $laporanKesehatan->jenis_kegiatan }}</p>
                            <p><strong>Dicatat Oleh:</strong> {{ $laporanKesehatan->user->name ?? 'N/A' }}</p>
                            <p class="col-span-2 mt-4"><strong>Deskripsi:</strong> {{ $laporanKesehatan->deskripsi_laporan }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4 text-red-600 dark:text-red-400">Detail Kasus Penyakit</h3>
                        
                        @if($laporanKesehatan->detailPenyakit->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada detail penyakit yang tercatat dalam laporan ini.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Penyakit</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Penduduk Terkait</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Jumlah Kasus</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($laporanKesehatan->detailPenyakit as $detail)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $detail->kategoriPenyakit->nama_penyakit ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $detail->penduduk->nama_lengkap ?? 'Penduduk Dihapus' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $detail->jumlah_kasus }}</td>
                                                <td class="px-6 py-4">{{ $detail->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                    <a href="{{ route('laporan-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali ke Daftar Laporan
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>