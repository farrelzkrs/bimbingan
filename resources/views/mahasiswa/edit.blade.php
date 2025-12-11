@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-8">
      <h4 class="mb-0">Edit Mahasiswa</h4>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Data Mahasiswa</h5>
        </div>
        <div class="card-body">
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

          <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
                                        @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                value="{{ old('nama', $mahasiswa->nama) }}" required>
              @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
              <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror" 
                value="{{ old('nim', $mahasiswa->nim) }}" required>
              @error('nim')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="angkatan" class="form-label">Angkatan</label>
              <input type="text" name="angkatan" id="angkatan" class="form-control @error('angkatan') is-invalid @enderror" 
                value="{{ old('angkatan', $mahasiswa->angkatan) }}">
              @error('angkatan')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Perbarui Mahasiswa
              </button>
              <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
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
          <p class="small text-muted">Edit data mahasiswa sesuai kebutuhan. Pastikan NIM valid dan unik.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
