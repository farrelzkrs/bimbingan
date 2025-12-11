@extends('layouts.app')

@section('title', 'Daftar Skripsi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">Daftar Skripsi</h4>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('skripsi.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Tambah Skripsi
      </a>
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
            <th>Dosen</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($skripsis as $skripsi)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td><strong>{{ $skripsi->mahasiswa->nama }}</strong></td>
            <td>{{ Str::limit($skripsi->judul, 40) }}</td>
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
                  <a class="dropdown-item" href="{{ route('skripsi.edit', $skripsi) }}">
                    <i class="bx bx-pencil"></i> Edit
                  </a>
                  <form action="{{ route('skripsi.destroy', $skripsi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item">
                      <i class="bx bx-trash"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted">Tidak ada data skripsi</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {!! $skripsis->links() !!}
  </div>
</div>
@endsection
