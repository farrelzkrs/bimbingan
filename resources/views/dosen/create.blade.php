@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-8">
      <h4 class="mb-0">Tambah Dosen Baru</h4>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Data Dosen</h5>
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

          <form action="{{ route('dosen.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
              <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                    {{ $user->name }} ({{ $user->email }})
                  </option>
                @endforeach
              </select>
              @error('user_id')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                value="{{ old('nama') }}" required>
              @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
              <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" 
                value="{{ old('nip') }}" required>
              @error('nip')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="spesialisasi" class="form-label">Spesialisasi</label>
              <input type="text" name="spesialisasi" id="spesialisasi" class="form-control @error('spesialisasi') is-invalid @enderror" 
                value="{{ old('spesialisasi') }}" placeholder="Contoh: Teknologi Informasi">
              @error('spesialisasi')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Dosen
              </button>
              <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
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
          <p class="small text-muted">Pastikan data dosen sudah terdaftar sebagai user terlebih dahulu sebelum menambahkan data di sini. Gunakan nomor induk pegawai (NIP) yang sesuai dengan data universitas.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
