<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Laporan Kesehatan') . ' - Tgl ' . \Carbon\Carbon::parse($laporanKesehatan->tanggal_laporan)->format('d/m/Y') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Validasi Gagal!</strong>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('laporan-kesehatan.update', $laporanKesehatan) }}" method="POST">
                        @csrf
                        @method('PUT') <h3 class="text-xl font-semibold mb-4 text-indigo-600 dark:text-indigo-400">Data Induk Laporan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div class="mb-4">
                                <label for="tanggal_laporan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Laporan</label>
                                <input type="date" name="tanggal_laporan" id="tanggal_laporan" 
                                       {{-- PERBAIKAN KRITIS: Memformat tanggal ke YYYY-MM-DD --}}
                                       value="{{ old('tanggal_laporan', \Carbon\Carbon::parse($laporanKesehatan->tanggal_laporan)->format('Y-m-d')) }}" 
                                       required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('tanggal_laporan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="fasilitas_kesehatan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fasilitas Pencatat</label>
                                <select name="fasilitas_kesehatan_id" id="fasilitas_kesehatan_id" required 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                    <option value="">-- Pilih Fasilitas Kesehatan --</option>
                                    @foreach($fasilitas as $f)
                                        <option value="{{ $f->id }}" {{ old('fasilitas_kesehatan_id', $laporanKesehatan->fasilitas_kesehatan_id) == $f->id ? 'selected' : '' }}>
                                            {{ $f->nama_faskes }} 
                                        </option>
                                    @endforeach
                                </select>
                                @error('fasilitas_kesehatan_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4 col-span-1">
                                <label for="jenis_kegiatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kegiatan</label>
                                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan', $laporanKesehatan->jenis_kegiatan) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('jenis_kegiatan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4 col-span-2">
                                <label for="deskripsi_laporan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi/Ringkasan Laporan</label>
                                <textarea name="deskripsi_laporan" id="deskripsi_laporan" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('deskripsi_laporan', $laporanKesehatan->deskripsi_laporan) }}</textarea>
                                @error('deskripsi_laporan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-6 border-gray-300 dark:border-gray-700">

                        <h3 class="text-xl font-semibold mb-4 text-red-600 dark:text-red-400">Detail Kasus Penyakit Tercatat (Read Only)</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Penyakit</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Penduduk</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Kasus</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($laporanKesehatan->detailPenyakit as $detail)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detail->kategoriPenyakit->nama_penyakit ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detail->penduduk->nama_lengkap ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $detail->jumlah_kasus }}</td>
                                            <td class="px-6 py-4">{{ $detail->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            @if($laporanKesehatan->detailPenyakit->isEmpty())
                                <p class="text-gray-500 mt-4">Tidak ada detail kasus tercatat.</p>
                            @endif
                        </div>


                        <div class="flex justify-end mt-6">
                            <a href="{{ route('laporan-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Perbarui Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>