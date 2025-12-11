@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">Edit User</h4>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('user.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <h6 class="mb-2">Terjadi Kesalahan:</h6>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Informasi User</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label" for="name">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label" for="password">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password jika mengubah">
            </div>

            <div class="mb-3">
              <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
              <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Dosen)</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Mahasiswa)</option>
              </select>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
              </button>
              <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Bantuan</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <h6 class="mb-2">Informasi Role:</h6>
            <ul class="list-unstyled text-muted small">
              <li class="mb-2"><strong>Admin (Dosen):</strong> Memiliki akses penuh ke sistem</li>
              <li><strong>User (Mahasiswa):</strong> Akses terbatas pada data pribadi</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
