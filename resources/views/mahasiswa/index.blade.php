@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">Daftar Mahasiswa</h4>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Tambah Mahasiswa
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
            <th>Nama</th>
            <th>NIM</th>
            <th>Angkatan</th>
            <th>User Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @php $i = 0; @endphp
          @forelse($mahasiswas as $mahasiswa)
          <tr>
            <td>{{ ++$i }}</td>
            <td><strong>{{ $mahasiswa->nama }}</strong></td>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->angkatan }}</td>
            <td>{{ $mahasiswa->user->email }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('mahasiswa.edit', $mahasiswa) }}">
                    <i class="bx bx-pencil"></i> Edit
                  </a>
                  <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
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
            <td colspan="6" class="text-center text-muted">Tidak ada data mahasiswa</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {!! $mahasiswas->links() !!}
  </div>
</div>
@endsection
