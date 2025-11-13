<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Data Ibu Hamil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
                    @endif
                    
                    <a href="{{ route('ibuhamil.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        + Tambah Catatan Ibu Hamil
                    </a>

                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Ibu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usia Kehamilan (Mg)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TPL (Perkiraan Lahir)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Risiko</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($ibuHamils as $index => $ih)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + $ibuHamils->firstItem() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $ih->penduduk->nama_lengkap ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $ih->usia_kehamilan_minggu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($ih->tanggal_perkiraan_lahir)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $ih->risiko_kehamilan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('ibuhamil.edit', $ih) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-3">Edit</a>
                                            
                                            <form action="{{ route('ibuhamil.destroy', $ih) }}" method="POST" class="inline" onsubmit="return confirm('Hapus catatan Ibu Hamil ini?');">
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
                            {{ $ibuHamils->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>