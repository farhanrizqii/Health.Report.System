<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Catatan Ibu Hamil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('ibuhamil.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="penduduk_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Penduduk (Ibu)</label>
                            <select name="penduduk_id" id="penduduk_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Cari dan Pilih Ibu (Perempuan & Belum Tercatat) --</option>
                                @foreach($penduduks as $p)
                                    <option value="{{ $p->id }}" {{ old('penduduk_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_lengkap }} (NIK: {{ $p->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_mulai_hamil" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai Hamil</label>
                            <input type="date" name="tanggal_mulai_hamil" id="tanggal_mulai_hamil" value="{{ old('tanggal_mulai_hamil') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_mulai_hamil')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="usia_kehamilan_minggu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usia Kehamilan (Minggu)</label>
                            <input type="number" name="usia_kehamilan_minggu" id="usia_kehamilan_minggu" value="{{ old('usia_kehamilan_minggu') }}" required min="1" max="42" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('usia_kehamilan_minggu')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_perkiraan_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Perkiraan Lahir (TPL)</label>
                            <input type="date" name="tanggal_perkiraan_lahir" id="tanggal_perkiraan_lahir" value="{{ old('tanggal_perkiraan_lahir') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_perkiraan_lahir')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="golongan_darah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Golongan Darah</label>
                            <select name="golongan_darah" id="golongan_darah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Golongan Darah --</option>
                                @foreach($golonganDarah as $gd)
                                    <option value="{{ $gd }}" {{ old('golongan_darah') == $gd ? 'selected' : '' }}>
                                        {{ $gd }}
                                    </option>
                                @endforeach
                            </select>
                            @error('golongan_darah')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="risiko_kehamilan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Risiko Kehamilan</label>
                            <select name="risiko_kehamilan" id="risiko_kehamilan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Tingkat Risiko --</option>
                                @foreach($risiko as $r)
                                    <option value="{{ $r }}" {{ old('risiko_kehamilan') == $r ? 'selected' : '' }}>
                                        {{ $r }}
                                    </option>
                                @endforeach
                            </select>
                            @error('risiko_kehamilan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="keterangan_lain" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Tambahan</label>
                            <textarea name="keterangan_lain" id="keterangan_lain" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('keterangan_lain') }}</textarea>
                            @error('keterangan_lain')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('ibuhamil.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan Catatan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>