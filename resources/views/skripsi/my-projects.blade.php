@extends('layouts.app')

@section('title', 'Skripsi Saya')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">
          @if(auth()->user()->role == 'user')
              Skripsi Saya
          @else
              Daftar Bimbingan Saya
          @endif
      </h4>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Judul</th>
            <th>Dosen Pembimbing</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($skripsis as $skripsi)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <strong>{{ $skripsi->mahasiswa->nama }}</strong>
                <br>
                <small class="text-muted">{{ $skripsi->mahasiswa->nim }}</small>
            </td>
            <td>{{ Str::limit($skripsi->judul, 50) }}</td>
            <td>{{ $skripsi->dosen->nama }}</td>
            <td>
              @if($skripsi->status === 'pending')
                <span class="badge bg-label-warning">Menunggu</span>
              @elseif($skripsi->status === 'ongoing')
                <span class="badge bg-label-primary">Berjalan</span>
              @else
                <span class="badge bg-label-success">Selesai</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    {{-- Mahasiswa hanya bisa lihat detail/edit jika status masih pending atau sesuai aturan --}}
                    @if(auth()->user()->role == 'user')
                        <a class="dropdown-item" href="{{ route('skripsi.edit', $skripsi) }}">
                            <i class="bx bx-pencil"></i> Edit Pengajuan
                        </a>
                    @else
                        {{-- Dosen/Admin --}}
                        <a class="dropdown-item" href="{{ route('skripsi.edit', $skripsi) }}">
                            <i class="bx bx-search-alt"></i> Detail & Validasi
                        </a>
                    @endif
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-5">
                <div class="d-flex flex-column align-items-center">
                    <i class="bx bx-folder-open fs-1 mb-2"></i>
                    <p class="mb-0">Belum ada data skripsi.</p>
                    @if(auth()->user()->role == 'user')
                        <a href="{{ route('skripsi.create') }}" class="btn btn-primary btn-sm mt-3">Ajukan Judul</a>
                    @endif
                </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection