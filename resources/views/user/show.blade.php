@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">Detail User</h4>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('user.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Informasi User</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <p class="text-muted mb-0">{{ $user->name }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <p class="text-muted mb-0">{{ $user->email }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <p class="mb-0">
              <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'info' }}">
                {{ $user->role === 'admin' ? 'Admin (Dosen)' : 'User (Mahasiswa)' }}
              </span>
            </p>
          </div>

          <div class="mb-3">
            <label class="form-label">Terdaftar Sejak</label>
            <p class="text-muted mb-0">{{ $user->created_at->format('d M Y H:i') }}</p>
          </div>

          <div class="mt-4">
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">
              <i class="bx bx-pencil"></i> Edit
            </a>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="bx bx-trash"></i> Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Status</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <span class="badge bg-success">Aktif</span>
          </div>
          <p class="text-muted small">User ini memiliki akses aktif ke sistem</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
