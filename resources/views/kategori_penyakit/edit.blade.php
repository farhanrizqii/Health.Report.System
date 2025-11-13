<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori Penyakit') . ' - ' . $kategoriPenyakit->nama_penyakit }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('kategori-penyakit.update', $kategoriPenyakit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Penyakit -->
                        <div class="mb-4">
                            <label for="nama_penyakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Penyakit</label>
                            <input type="text" name="nama_penyakit" id="nama_penyakit" value="{{ old('nama_penyakit', $kategoriPenyakit->nama_penyakit) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('nama_penyakit')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode ICD -->
                        <div class="mb-4">
                            <label for="kode_icd" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode ICD (Opsional)</label>
                            <input type="text" name="kode_icd" id="kode_icd" value="{{ old('kode_icd', $kategoriPenyakit->kode_icd) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('kode_icd')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('kategori-penyakit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui Kategori</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>