<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Catatan Imunisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('imunisasi.update', $imunisasi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="penduduk_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Penduduk</label>
                            <select name="penduduk_id" id="penduduk_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Cari dan Pilih Penduduk --</option>
                                @foreach($penduduks as $p)
                                    <option value="{{ $p->id }}" {{ old('penduduk_id', $imunisasi->penduduk_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_lengkap }} (NIK: {{ $p->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_imunisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Imunisasi</label>
                            <select name="jenis_imunisasi" id="jenis_imunisasi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Jenis Imunisasi --</option>
                                @foreach($jenisImunisasi as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis_imunisasi', $imunisasi->jenis_imunisasi) == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_imunisasi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_imunisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Imunisasi</label>
                            <input type="date" name="tanggal_imunisasi" id="tanggal_imunisasi" value="{{ old('tanggal_imunisasi', $imunisasi->tanggal_imunisasi) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_imunisasi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan (Batch, Dosis, dll.)</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('keterangan', $imunisasi->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('imunisasi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui Catatan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>