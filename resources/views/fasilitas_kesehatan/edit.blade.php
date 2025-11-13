<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Fasilitas Kesehatan') . ' - ' . $fasilitasKesehatan->nama_fasilitas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('fasilitas-kesehatan.update', $fasilitasKesehatan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nama_fasilitas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" id="nama_fasilitas" value="{{ old('nama_fasilitas', $fasilitasKesehatan->nama_fasilitas) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nama_fasilitas')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_fasilitas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Fasilitas</label>
                            <select name="jenis_fasilitas" id="jenis_fasilitas" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Puskesmas" {{ old('jenis_fasilitas', $fasilitasKesehatan->jenis_fasilitas) == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                                <option value="Posyandu" {{ old('jenis_fasilitas', $fasilitasKesehatan->jenis_fasilitas) == 'Posyandu' ? 'selected' : '' }}>Posyandu</option>
                                <option value="Klinik" {{ old('jenis_fasilitas', $fasilitasKesehatan->jenis_fasilitas) == 'Klinik' ? 'selected' : '' }}>Klinik</option>
                                <option value="Lainnya" {{ old('jenis_fasilitas', $fasilitasKesehatan->jenis_fasilitas) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_fasilitas')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('alamat', $fasilitasKesehatan->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon (Opsional)</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $fasilitasKesehatan->nomor_telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nomor_telepon')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('fasilitas-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui Fasilitas</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>