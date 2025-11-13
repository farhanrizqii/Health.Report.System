<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Penduduk') . ' - ' . $penduduk->nama_lengkap }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('penduduk.update', $penduduk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wilayah (Kelurahan/Desa)</label>
                            <select name="wilayah_id" id="wilayah_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" {{ old('wilayah_id', $penduduk->wilayah_id) == $wilayah->id ? 'selected' : '' }}>
                                        {{ $wilayah->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik', $penduduk->nik) }}" required maxlength="16" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nik')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nama_lengkap')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('tanggal_lahir')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} required class="form-radio dark:bg-gray-700 dark:border-gray-600 dark:text-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }} required class="form-radio dark:bg-gray-700 dark:border-gray-600 dark:text-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('alamat', $penduduk->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon (Opsional)</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $penduduk->nomor_telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nomor_telepon')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('penduduk.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>