<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold">Judul Skripsi: {{ $skripsi->judul }}</h3>
                    <p class="text-gray-600">Dosen Pembimbing: {{ $skripsi->dosen->nama }}</p>
                </div>

                <h4 class="font-medium text-lg mb-4">Feedback & Revisi</h4>
                
                <div class="space-y-6">
                    @forelse($bimbingans as $log)
                        <div class="flex flex-col md:flex-row gap-4 border p-4 rounded-lg shadow-sm {{ $log->status == 'done' ? 'border-green-400 bg-green-50' : 'border-gray-200 bg-white' }}">
                            
                            <div class="md:w-1/4 border-r border-gray-100 pr-4">
                                <p class="text-sm text-gray-500 font-semibold">Tanggal</p>
                                <p class="text-gray-900">{{ $log->created_at->format('d F Y') }}</p>
                                <p class="text-gray-500 text-xs">{{ $log->created_at->format('H:i WIB') }}</p>
                                
                                <div class="mt-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded {{ $log->status == 'done' ? 'bg-green-200 text-green-800' : 'bg-orange-200 text-orange-800' }}">
                                        {{ strtoupper($log->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="md:w-3/4">
                                <p class="text-sm text-gray-500 font-semibold mb-1">Catatan Dosen:</p>
                                <div class="text-gray-800 whitespace-pre-line mb-3 bg-gray-50 p-3 rounded">
                                    {{ $log->catatan ?: 'Tidak ada catatan teks.' }}
                                </div>

                                @if($log->file_surat)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $log->file_surat) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            📄 Download Lampiran Revisi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded border border-dashed border-gray-300">
                            <p class="text-gray-500">Belum ada catatan bimbingan dari dosen.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>