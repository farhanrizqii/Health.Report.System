<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl font-bold mb-6 border-b pb-2 dark:border-gray-600">
                        {{ $kegiatanPosyandu->jenis_kegiatan }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base">
                        <div>
                            <p class="font-semibold text-gray-500 dark:text-gray-400">ID Kegiatan:</p>
                            <p class="mb-4">{{ $kegiatanPosyandu->id }}</p>

                            <p class="font-semibold text-gray-500 dark:text-gray-400">Jenis Kegiatan:</p>
                            <p class="mb-4">{{ $kegiatanPosyandu->jenis_kegiatan }}</p>

                            <p class="font-semibold text-gray-500 dark:text-gray-400">Tanggal Pelaksanaan:</p>
                            <p class="mb-4">{{ \Carbon\Carbon::parse($kegiatanPosyandu->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-gray-500 dark:text-gray-400">Wilayah Pelaksana:</p>
                            <p class="mb-4">
                                {{ $kegiatanPosyandu->wilayah->kelurahan ?? 'N/A' }} 
                                @if($kegiatanPosyandu->wilayah)
                                    (RT/RW: {{ $kegiatanPosyandu->wilayah->rt }}/{{ $kegiatanPosyandu->wilayah->rw }})
                                @endif
                            </p>
                            
                            <p class="font-semibold text-gray-500 dark:text-gray-400">Jumlah Peserta:</p>
                            <p class="mb-4">{{ $kegiatanPosyandu->jumlah_peserta }}</p>
                            
                            <p class="font-semibold text-gray-500 dark:text-gray-400">Dibuat Pada:</p>
                            <p class="mb-4">{{ $kegiatanPosyandu->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 border-t pt-4 dark:border-gray-700">
                        <p class="font-semibold text-gray-500 dark:text-gray-400">Keterangan:</p>
                        <p class="whitespace-pre-wrap">{{ $kegiatanPosyandu->keterangan ?? 'Tidak ada keterangan.' }}</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('kegiatan-posyandu.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>