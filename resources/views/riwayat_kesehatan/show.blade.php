<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Riwayat Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">

                <h3 class="text-2xl font-bold mb-6 text-indigo-600 dark:text-indigo-400 border-b pb-2">{{ $riwayatKesehatan->penduduk->nama_lengkap ?? 'N/A' }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 dark:text-gray-300">
                    
                    <div>
                        <p class="font-semibold text-lg border-b pb-1">Diagnosa & Status</p>
                        <p class="mt-2"><strong>Penyakit:</strong> {{ $riwayatKesehatan->kategoriPenyakit->nama_penyakit ?? 'Tidak Dikenal' }}</p>
                        <p><strong>Status Saat Ini:</strong> <span class="font-bold text-red-500">{{ $riwayatKesehatan->hasil }}</span></p>
                        <p><strong>Jenis Pemeriksaan:</strong> {{ $riwayatKesehatan->jenis_pemeriksaan ?? '-' }}</p>
                        <p><strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($riwayatKesehatan->tanggal_pemeriksaan)->format('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-lg border-b pb-1">Data Penduduk</p>
                        <p class="mt-2"><strong>NIK:</strong> {{ $riwayatKesehatan->penduduk->nik ?? '-' }}</p>
                        <p><strong>Wilayah:</strong> {{ $riwayatKesehatan->penduduk->wilayah->kelurahan ?? '-' }}</p>
                        <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($riwayatKesehatan->penduduk->tanggal_lahir)->age ?? '-' }} Tahun</p>
                    </div>

                    <div class="md:col-span-2 border-t pt-4 mt-4">
                        <p class="font-semibold">Keterangan Diagnosa/Tindakan:</p>
                        <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded text-sm italic">
                            {{ $riwayatKesehatan->tindakan ?? '— Tidak ada keterangan tindakan tercatat —' }}
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex gap-3">
                    <a href="{{ route('riwayat-kesehatan.edit', $riwayatKesehatan) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Edit Data</a>
                    <a href="{{ route('riwayat-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>