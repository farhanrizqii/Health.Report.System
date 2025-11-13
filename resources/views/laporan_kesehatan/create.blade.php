<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Laporan Kesehatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('laporan-kesehatan.store') }}" method="POST">
                        @csrf
                        
                        <h3 class="text-xl font-semibold mb-4 text-indigo-600 dark:text-indigo-400">Data Induk Laporan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div class="mb-4">
                                <label for="tanggal_laporan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Laporan</label>
                                <input type="date" name="tanggal_laporan" id="tanggal_laporan" value="{{ old('tanggal_laporan', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('tanggal_laporan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="fasilitas_kesehatan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fasilitas Pencatat</label>
                                <select name="fasilitas_kesehatan_id" id="fasilitas_kesehatan_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                    <option value="">-- Pilih Fasilitas --</option>
                                    @foreach($fasilitas as $f)
                                        <option value="{{ $f->id }}" {{ old('fasilitas_kesehatan_id') == $f->id ? 'selected' : '' }}>
                                            {{ $f->nama_fasilitas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fasilitas_kesehatan_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4 col-span-1">
                                <label for="jenis_kegiatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kegiatan</label>
                                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                @error('jenis_kegiatan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4 col-span-2">
                                <label for="deskripsi_laporan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi/Ringkasan Laporan</label>
                                <textarea name="deskripsi_laporan" id="deskripsi_laporan" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('deskripsi_laporan') }}</textarea>
                                @error('deskripsi_laporan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-6 border-gray-300 dark:border-gray-700">

                        <h3 class="text-xl font-semibold mb-4 text-red-600 dark:text-red-400">Detail Kasus Penyakit Tercatat</h3>
                        
                        <div id="detail-container">
                            <div class="detail-row border border-gray-200 dark:border-gray-700 p-4 rounded-lg mb-4" data-index="0">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    
                                    <div class="col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penyakit</label>
                                        <select name="detail[0][kategori_penyakit_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                            <option value="">-- Pilih Penyakit --</option>
                                            @foreach($penyakits as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_penyakit }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penduduk Terkait</label>
                                        <select name="detail[0][penduduk_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                            <option value="">-- Pilih Penduduk --</option>
                                            @foreach($penduduks as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_lengkap }} ({{ $p->nik }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Kasus</label>
                                        <input type="number" name="detail[0][jumlah_kasus]" value="1" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                    </div>

                                    <div class="col-span-1 flex items-end">
                                        <button type="button" class="remove-detail-row bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Hapus</button>
                                    </div>
                                    
                                    <div class="col-span-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Khusus</label>
                                        <input type="text" name="detail[0][keterangan]" placeholder="Contoh: Lokasi temuan, tindakan awal." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                    </div>

                                </div>
                            </div>
                            </div>

                        <button type="button" id="add-detail-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">
                            + Tambah Kasus Penyakit
                        </button>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('laporan-kesehatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Kloning template baris detail (baris pertama)
            var detailTemplate = $('.detail-row[data-index="0"]').clone();
            var indexCounter = 1;

            // Kosongkan input di template agar baris baru bersih
            detailTemplate.find('select, input[type="number"], input[type="text"]').val('');

            // 1. Fungsi untuk menambahkan baris detail
            $('#add-detail-button').click(function() {
                var newRow = detailTemplate.clone();
                
                // Perbarui atribut name dan data-index
                newRow.attr('data-index', indexCounter);
                newRow.find('select, input').each(function() {
                    var name = $(this).attr('name');
                    if (name) {
                        // Ganti [0] dengan indeks baru ([1], [2], dst.)
                        $(this).attr('name', name.replace(/\[\d+\]/g, '[' + indexCounter + ']'));
                    }
                    // Kosongkan nilai input baru
                    $(this).val('');
                });
                
                // Tampilkan tombol Hapus pada baris baru
                newRow.find('.remove-detail-row').show();
                
                $('#detail-container').append(newRow);
                indexCounter++;
            });

            // 2. Fungsi untuk menghapus baris detail
            $('#detail-container').on('click', '.remove-detail-row', function() {
                // Hapus baris detail yang relevan
                if ($('#detail-container').children('.detail-row').length > 1) {
                    $(this).closest('.detail-row').remove();
                } else {
                    alert('Minimal harus ada satu detail kasus yang tercatat.');
                }
            });
            
            // 3. Sembunyikan tombol hapus pada baris pertama saat inisialisasi
            $('.detail-row[data-index="0"]').find('.remove-detail-row').hide();
        });
    </script>
</x-app-layout>