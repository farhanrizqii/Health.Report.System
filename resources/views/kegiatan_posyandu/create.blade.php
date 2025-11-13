<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Jadwal Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('kegiatan-posyandu.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wilayah Pelaksana</label>
                            <select name="wilayah_id" id="wilayah_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" {{ old('wilayah_id') == $wilayah->id ? 'selected' : '' }}>
                                        {{ $wilayah->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nama_kegiatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_kegiatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_kegiatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Mulai (HH:MM)</label>
                                <input type="text" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}" placeholder="08:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('waktu_mulai')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Selesai (HH:MM)</label>
                                <input type="text" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}" placeholder="10:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('waktu_selesai')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Kegiatan (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('kegiatan-posyandu.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan Jadwal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>