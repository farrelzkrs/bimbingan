<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bimbingan Skripsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                <h3 class="text-lg font-bold mb-4">Kirim Progress / Draft Skripsi</h3>
                <form action="{{ route('bimbingan.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="catatan" :value="__('Deskripsi Progress (Apa yang Anda kerjakan?)')" />
                        <textarea id="catatan" name="catatan" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Contoh: Saya sudah menyelesaikan Bab 3, mohon koreksinya pak/bu." required></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="file_surat" :value="__('Upload File Draft (PDF/Docx)')" />
                        <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 mt-1" />
                        <p class="text-xs text-gray-400 mt-1 italic">*Opsional jika hanya ingin mengirim pesan teks.</p>
                    </div>

                    <x-primary-button>Kirim Ke Dosen</x-primary-button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-indigo-700">Informasi Skripsi</h3>
                    <p class="text-gray-700"><strong>Judul:</strong> {{ $skripsi->judul }}</p>
                    <p class="text-gray-600"><strong>Dosen Pembimbing:</strong> {{ $skripsi->dosen->nama }}</p>
                </div>

                <h4 class="font-medium text-lg mb-4">Log Aktivitas & Feedback</h4>
                
                <div class="space-y-4">
                    @forelse($bimbingans as $log)
                        <div class="p-4 rounded-lg border {{ $log->status == 'done' ? 'bg-green-50 border-green-200' : ($log->status == 'pending' ? 'bg-blue-50 border-blue-200' : 'bg-white border-gray-200') }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-xs font-semibold uppercase px-2 py-0.5 rounded {{ $log->status == 'done' ? 'bg-green-200 text-green-800' : ($log->status == 'pending' ? 'bg-blue-200 text-blue-800' : 'bg-orange-200 text-orange-800') }}">
                                        {{ $log->status }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $log->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <p class="text-sm font-bold text-gray-600">Pesan/Catatan:</p>
                                <p class="text-gray-800 whitespace-pre-line">{{ $log->catatan }}</p>
                            </div>

                            @if($log->file_surat)
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <a href="{{ asset('storage/' . $log->file_surat) }}" target="_blank" class="text-indigo-600 hover:underline text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Lihat/Unduh Lampiran
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500 italic">
                            Belum ada riwayat bimbingan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>