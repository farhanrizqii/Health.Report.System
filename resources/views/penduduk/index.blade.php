<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Data Penduduk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">{{ session('error') }}</div>
                    @endif
                    
                    <a href="{{ route('penduduk.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        + Tambah Data Penduduk
                    </a>

                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK / Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Wilayah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">L/P</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Lahir</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($penduduks as $index => $penduduk)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + $penduduks->firstItem() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $penduduk->nama_lengkap }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $penduduk->nik }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $penduduk->wilayah->nama_wilayah ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $penduduk->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('penduduk.edit', $penduduk) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-3">Edit</a>
                                            
                                            <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data {{ $penduduk->nama_lengkap }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $penduduks->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>