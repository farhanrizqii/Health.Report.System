<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jadwal Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-3">
                        <div class="flex gap-3 w-full md:w-auto">
                            <a href="{{ route('kegiatan-posyandu.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto text-center">
                                + Tambah Jadwal Kegiatan
                            </a>
                            <a href="{{ route('kegiatan-posyandu.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto text-center">
                                📥 Ekspor Excel
                            </a>
                        </div>
                        
                        <form method="GET" action="{{ route('kegiatan-posyandu.index') }}" class="w-full md:w-1/3">
                            <div class="flex items-center space-x-2">
                                <input type="text" name="search" placeholder="Cari Kegiatan atau Wilayah..." 
                                       value="{{ request('search') }}"
                                       class="form-input w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-gray-100 dark:hover:bg-gray-500 py-2 px-4 rounded">
                                    Cari
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('kegiatan-posyandu.index') }}" class="text-sm text-red-600 dark:text-red-400 hover:text-red-800">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Jenis Kegiatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Wilayah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tanggal</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($kegiatans as $index => $k)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + $kegiatans->firstItem() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $k->jenis_kegiatan }}</td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="font-semibold dark:text-gray-300">{{ $k->wilayah->kelurahan ?? 'N/A' }}</span>
                                            @if ($k->wilayah->rt)
                                                <br><span class="text-xs text-gray-500 dark:text-gray-400">(RT: {{ $k->wilayah->rt }}/RW: {{ $k->wilayah->rw }})</span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($k->tanggal)->format('d F Y') }} 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('kegiatan-posyandu.show', $k) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-600 mr-3">Detail</a>
                                            
                                            <a href="{{ route('kegiatan-posyandu.edit', $k) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-3">Edit</a>
                                            
                                            <form action="{{ route('kegiatan-posyandu.destroy', $k) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kegiatan {{ $k->jenis_kegiatan }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada kegiatan ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $kegiatans->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>