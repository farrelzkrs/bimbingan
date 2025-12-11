@extends('layouts.app')

@section('title', 'Edit Pengajuan Skripsi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Skripsi /</span> Perbarui Pengajuan</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Revisi / Pembaruan</h5>
                
                <div class="card-body">
                    <form action="{{ route('skripsi.update', $skripsi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Judul Skripsi</label>
                            <input type="text" class="form-control" name="judul" value="{{ old('judul', $skripsi->judul) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi / Abstrak</label>
                            <textarea class="form-control" name="deskripsi" rows="4" required>{{ old('deskripsi', $skripsi->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dosen Pembimbing</label>
                            @if(auth()->user()->role === 'user')
                                {{-- Tampilan Mahasiswa: Hanya teks, tidak bisa diganti --}}
                                <input type="text" class="form-control bg-light" value="{{ $skripsi->dosen->nama }}" readonly>
                                <div class="form-text">Anda tidak dapat mengganti dosen pembimbing saat revisi.</div>
                            @else
                                {{-- Tampilan Admin: Dropdown bisa dipilih --}}
                                <select class="form-select" name="dosen_id">
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" {{ $skripsi->dosen_id == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-primary">Upload File Revisi (Opsional)</label>
                            <input type="file" class="form-control" name="dokumen">
                            <div class="form-text">
                                Upload file baru jika ada revisi pada dokumen skripsi.
                                @if($skripsi->dokumen)
                                    <br>File saat ini: <a href="{{ asset('storage/' . $skripsi->dokumen) }}" target="_blank">Lihat Dokumen</a>
                                @endif
                            </div>
                        </div>

                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'dosen')
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="pending" {{ $skripsi->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="ongoing" {{ $skripsi->status == 'ongoing' ? 'selected' : '' }}>Sedang Berjalan</option>
                                    <option value="completed" {{ $skripsi->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        @else
                            {{-- Info untuk mahasiswa bahwa status akan reset --}}
                            <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                                <i class="bx bx-error me-2"></i>
                                <div>
                                    <strong>Perhatian:</strong> Menyimpan perubahan ini akan mengulang status pengajuan menjadi <strong>"Menunggu Validasi"</strong>.
                                </div>
                            </div>
                        @endif

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan & Ajukan Ulang</button>
                            <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection