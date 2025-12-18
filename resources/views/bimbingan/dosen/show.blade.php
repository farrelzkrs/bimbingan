<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bimbingan: {{ $skripsi->mahasiswa->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Tambah Catatan / Revisi</h3>
                <form action="{{ route('bimbingan.dosen.store', $skripsi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="catatan" :value="__('Catatan Revisi / Notulen')" />
                        <textarea id="catatan" name="catatan" rows="4" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1"></textarea>
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="file_surat" :value="__('File Coretan / Revisi (Opsional)')" />
                        <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-1"/>
                        <x-input-error :messages="$errors->get('file_surat')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status Bimbingan')" />
                        <select name="status" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1">
                            <option value="revisi">Revisi</option>
                            <option value="done">Done (ACC)</option>
                        </select>
                    </div>

                    <x-primary-button>Kirim ke Mahasiswa</x-primary-button>
                </form>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Riwayat Bimbingan</h3>
                <div class="space-y-4">
                    @forelse($riwayat_bimbingan as $log)
                        <div class="border p-4 rounded-lg {{ $log->status == 'done' ? 'bg-green-50 border-green-200' : 'bg-gray-50' }}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm text-gray-600">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <span class="px-2 py-1 text-xs rounded {{ $log->status == 'done' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </div>
                            <p class="text-gray-800 whitespace-pre-line">{{ $log->catatan }}</p>
                            @if($log->file_surat)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $log->file_surat) }}" target="_blank" class="text-sm text-indigo-600 hover:underline flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Unduh File Revisi
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada riwayat bimbingan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>