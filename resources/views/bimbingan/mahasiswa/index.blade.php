@extends('layouts.app')
@section('title', 'Hasil Bimbingan & Revisi')
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($skripsi)
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-900">Judul Skripsi Anda:</h3>
                <p class="text-gray-600 mt-1">{{ $skripsi->judul }}</p>
                <div class="mt-2">
                    <span class="text-sm font-semibold text-gray-500">Dosen Pembimbing:</span>
                    <span class="text-sm text-gray-800">{{ $skripsi->dosen->nama ?? 'Belum ditentukan' }}</span>
                </div>
            </div>
            @endif

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Kirim Progress / Balas Revisi</h3>
                <form action="{{ route('bimbingan.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="catatan" :value="__('Catatan / Keterangan')" />
                        <textarea name="catatan" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Contoh: Ini revisi bab 1 saya pak..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label for="file_surat" :value="__('Upload File Skripsi (PDF/Doc)')" />
                        <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 mt-1 file:py-2 file:px-4 file:rounded-md file:bg-indigo-50 file:text-indigo-700"/>
                    </div>
                    <x-primary-button>Kirim ke Dosen</x-primary-button>
                </form>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">History Revisi & Keputusan Dosen</h3>
                
                @if(isset($bimbingans) && $bimbingans->count() > 0)
                    <div class="space-y-6">
                        @foreach($bimbingans as $bimbingan)
                            <div class="flex flex-col border rounded-lg overflow-hidden {{ $bimbingan->status == 'done' ? 'border-green-400 bg-green-50' : ($bimbingan->status == 'revisi' ? 'border-red-300 bg-white' : 'border-gray-200 bg-gray-50') }}">
                                
                                <div class="px-4 py-3 border-b flex justify-between items-center {{ $bimbingan->status == 'done' ? 'bg-green-100' : 'bg-gray-100' }}">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-700">
                                            {{ $bimbingan->status == 'pending' ? 'Anda (Mahasiswa)' : 'Dosen Pembimbing' }}
                                        </span>
                                        <span class="text-xs text-gray-500">| {{ $bimbingan->created_at->format('d F Y, H:i') }}</span>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $bimbingan->status == 'done' ? 'bg-green-500 text-white' : ($bimbingan->status == 'revisi' ? 'bg-red-500 text-white' : 'bg-gray-500 text-white') }}">
                                        {{ strtoupper($bimbingan->status == 'done' ? 'ACC' : $bimbingan->status) }}
                                    </span>
                                </div>

                                <div class="p-4">
                                    <p class="text-gray-800 whitespace-pre-wrap">{{ $bimbingan->catatan }}</p>
                                    
                                    @if($bimbingan->file_surat)
                                        <div class="mt-4 pt-3 border-t border-gray-100">
                                            <a href="{{ asset('storage/' . $bimbingan->file_surat) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                Download Lampiran
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada data bimbingan.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection