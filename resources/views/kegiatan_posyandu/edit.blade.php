<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jadwal Kegiatan Posyandu') . ' - ' . $kegiatanPosyandu->jenis_kegiatan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('kegiatan-posyandu.update', $kegiatanPosyandu) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wilayah Pelaksana</label>
                            <select name="wilayah_id" id="wilayah_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" {{ old('wilayah_id', $kegiatanPosyandu->wilayah_id) == $wilayah->id ? 'selected' : '' }}>
                                        {{ $wilayah->kelurahan }} 
                                        @if ($wilayah->rw)
                                            (RW: {{ $wilayah->rw }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_kegiatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama/Jenis Kegiatan</label>
                            <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan', $kegiatanPosyandu->jenis_kegiatan) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('jenis_kegiatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $kegiatanPosyandu->tanggal) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Peserta (Opsional)</label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="{{ old('jumlah_peserta', $kegiatanPosyandu->jumlah_peserta) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('jumlah_peserta')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Kegiatan (Opsional)</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('keterangan', $kegiatanPosyandu->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('kegiatan-posyandu.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>