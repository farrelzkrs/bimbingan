@extends('layouts.app')

@section('title', 'Detail Skripsi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Skripsi /</span> Detail Pengajuan
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Skripsi</h5>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Judul Skripsi</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $skripsi->judul }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Mahasiswa</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $skripsi->mahasiswa->nama }} ({{ $skripsi->mahasiswa->nim }})</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Dosen Pembimbing</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $skripsi->dosen->nama }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Status</label>
                        <div class="col-sm-9">
                            @if($skripsi->status === 'pending')
                                <span class="badge bg-label-warning">Menunggu Validasi</span>
                            @elseif($skripsi->status === 'ongoing')
                                <span class="badge bg-label-primary">Sedang Berjalan / Revisi</span>
                            @else
                                <span class="badge bg-label-success">Selesai (ACC)</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Deskripsi / Abstrak</label>
                        <div class="col-sm-9">
                            <div class="p-3 bg-light rounded">
                                {{ $skripsi->deskripsi }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">File Dokumen</label>
                        <div class="col-sm-9">
                            @if($skripsi->dokumen)
                                <a href="{{ asset('storage/' . $skripsi->dokumen) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="bx bx-download me-1"></i> Unduh Dokumen
                                </a>
                            @else
                                <span class="text-muted fst-italic">Tidak ada dokumen yang diunggah.</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Edit hanya muncul untuk Admin atau Pemilik Skripsi --}}
                    @if(auth()->user()->role === 'admin' || auth()->user()->id === $skripsi->mahasiswa->user_id)
                    <div class="row mt-4">
                        <div class="col-sm-12 text-end">
                            <a href="{{ route('skripsi.edit', $skripsi->id) }}" class="btn btn-warning">Edit Pengajuan</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection