<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mahasiswa Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2">Nama Mahasiswa</th>
                                <th class="px-4 py-2">Judul Skripsi</th>
                                <th class="px-4 py-2">Dokumen Skripsi</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($skripsis as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $item->mahasiswa->nama }}</td>
                                <td class="px-4 py-2">{{ $item->judul }}</td>
                                <td class="px-4 py-2">
                                    @if($item->dokumen)
                                        <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('bimbingan.dosen.show', $item->id) }}" class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">
                                        Beri Bimbingan
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center">Belum ada mahasiswa bimbingan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>