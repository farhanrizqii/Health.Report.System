<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catat Riwayat Kesehatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('riwayat-kesehatan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="penduduk_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Penduduk</label>
                            <select name="penduduk_id" id="penduduk_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Cari dan Pilih Penduduk --</option>
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
                            <label for="penyakit_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Penyakit</label>
                            <select name="penyakit_id" id="penyakit_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Jenis Penyakit --</option>
                                @foreach($penyakits as $penyakit)
                                    <option value="{{ $penyakit->id }}" {{ old('penyakit_id') == $penyakit->id ? 'selected' : '' }}>
                                        {{ $penyakit->nama_penyakit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penyakit_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="jenis_pemeriksaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pemeriksaan/Diagnosa</label>
                            <input type="text" name="jenis_pemeriksaan" id="jenis_pemeriksaan" value="{{ old('jenis_pemeriksaan', 'Diagnosa Umum') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('jenis_pemeriksaan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_pemeriksaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pemeriksaan</label>
                            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_pemeriksaan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status_penyakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Penyakit Saat Ini</label>
                            <select name="status_penyakit" id="status_penyakit" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Status --</option>
                                <option value="Dirawat" {{ old('status_penyakit') == 'Dirawat' ? 'selected' : '' }}>Dirawat/Aktif</option>
                                <option value="Sembuh" {{ old('status_penyakit') == 'Sembuh' ? 'selected' : '' }}>Sembuh</option>
                                <option value="Kronis" {{ old('status_penyakit') == 'Kronis' ? 'selected' : '' }}>Kronis/Menahun</option>
                                <option value="Meninggal" {{ old('status_penyakit') == 'Meninggal' ? 'selected' : '' }}>Meninggal (Terkait Penyakit)</option>
                            </select>
                            @error('status_penyakit')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keterangan_diagnosa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Diagnosa</label>
                            <textarea name="keterangan_diagnosa" id="keterangan_diagnosa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('keterangan_diagnosa') }}</textarea>
                            @error('keterangan_diagnosa')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('riwayat-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan Riwayat</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>