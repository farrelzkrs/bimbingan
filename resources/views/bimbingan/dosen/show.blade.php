@extends('layouts.app')
@section('title', 'Bimbingan: {{ $skripsi->mahasiswa->nama }}')
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-blue-50 border border-blue-200 p-6 shadow sm:rounded-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-blue-900 mb-2">Data Skripsi Mahasiswa</h3>
                        <p class="text-gray-700 font-semibold text-lg">{{ $skripsi->judul }}</p>
                        <p class="text-gray-600 mt-1">{{ $skripsi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    
                    @if($skripsi->dokumen)
                    <div class="ml-4 flex-shrink-0">
                        <a href="{{ asset('storage/' . $skripsi->dokumen) }}" target="_blank" 
                           class="flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Download File Skripsi
                        </a>
                        <p class="text-xs text-center text-gray-500 mt-2">File Utama Mahasiswa</p>
                    </div>
                    @else
                    <div class="ml-4 bg-red-100 text-red-600 px-4 py-2 rounded">
                        File belum diupload
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4 border-b pb-2">Input Revisi / Keputusan</h3>
                
                <form action="{{ route('bimbingan.dosen.store', $skripsi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="catatan" :value="__('Catatan Revisi')" />
                        <textarea id="catatan" name="catatan" rows="4" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1" placeholder="Tuliskan detail revisi untuk mahasiswa..."></textarea>
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="file_surat" :value="__('File Coretan / Dokumen Revisi (Opsional)')" />
                            <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-1"/>
                            <x-input-error :messages="$errors->get('file_surat')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="status" :value="__('Status Keputusan')" />
                            <select name="status" id="status" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1">
                                <option value="revisi">Revisi (Kembalikan ke Mahasiswa)</option>
                                <option value="done" class="font-bold text-green-600">ACC (Selesai Bimbingan)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>Kirim Keputusan</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Riwayat Komunikasi</h3>
                <div class="space-y-4">
                    @forelse($riwayat_bimbingan as $log)
                        <div class="border p-4 rounded-lg {{ $log->status == 'done' ? 'bg-green-50 border-green-200' : ($log->status == 'pending' ? 'bg-blue-50 border-blue-200' : 'bg-yellow-50 border-yellow-200') }}">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-sm text-gray-700">
                                        {{ $log->status == 'pending' ? $skripsi->mahasiswa->nama : 'Anda (Dosen)' }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $log->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <span class="px-2 py-1 text-xs rounded font-bold 
                                    {{ $log->status == 'done' ? 'bg-green-200 text-green-800' : ($log->status == 'pending' ? 'bg-blue-200 text-blue-800' : 'bg-yellow-200 text-yellow-800') }}">
                                    {{ $log->status == 'done' ? 'ACC' : ($log->status == 'pending' ? 'Dari Mahasiswa' : 'Revisi Dosen') }}
                                </span>
                            </div>
                            
                            <p class="text-gray-800 whitespace-pre-line mb-2">{{ $log->catatan }}</p>
                            
                            @if($log->file_surat)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $log->file_surat) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Unduh Lampiran
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-8 bg-gray-50 border border-dashed rounded-lg">
                            <p class="text-gray-500">Belum ada history revisi atau catatan.</p>
                            <p class="text-sm text-gray-400">Silakan download file skripsi di atas dan berikan revisi pertama.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection