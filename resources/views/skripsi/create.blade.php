@extends('layouts.app')

@section('title', 'Tambah Skripsi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-8">
      <h4 class="mb-0">Tambah Skripsi Baru</h4>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Data Skripsi</h5>
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

          <form action="{{ route('skripsi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="mahasiswa_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
              <select name="mahasiswa_id" id="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" required>
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($mahasiswas as $mahasiswa)
                  <option value="{{ $mahasiswa->id }}" @selected(old('mahasiswa_id') == $mahasiswa->id)>
                    {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                  </option>
                @endforeach
              </select>
              @error('mahasiswa_id')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="dosen_id" class="form-label">Dosen Pembimbing <span class="text-danger">*</span></label>
              <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                  <option value="{{ $dosen->id }}" @selected(old('dosen_id') == $dosen->id)>
                    {{ $dosen->nama }} ({{ $dosen->spesialisasi }})
                  </option>
                @endforeach
              </select>
              @error('dosen_id')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="judul" class="form-label">Judul Skripsi <span class="text-danger">*</span></label>
              <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                value="{{ old('judul') }}" placeholder="Masukkan judul skripsi" required>
              @error('judul')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
              <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                rows="4" placeholder="Masukkan deskripsi skripsi" required>{{ old('deskripsi') }}</textarea>
              @error('deskripsi')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
              <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">-- Pilih Status --</option>
                <option value="pending" @selected(old('status') == 'pending')>Menunggu Persetujuan</option>
                <option value="ongoing" @selected(old('status') == 'ongoing')>Sedang Berjalan</option>
                <option value="completed" @selected(old('status') == 'completed')>Selesai</option>
              </select>
              @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Skripsi
              </button>
              <a href="{{ route('skripsi.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
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
          <p class="small text-muted mb-3"><strong>Status Skripsi:</strong></p>
          <ul class="small text-muted list-unstyled">
            <li>• <strong>Menunggu Persetujuan:</strong> Skripsi yang baru diajukan dan menunggu persetujuan pembimbing</li>
            <li>• <strong>Sedang Berjalan:</strong> Skripsi yang sudah disetujui dan dalam proses pengerjaan</li>
            <li>• <strong>Selesai:</strong> Skripsi yang telah selesai dikerjakan</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
