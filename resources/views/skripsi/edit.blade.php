<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Edit Skripsi</title>

    <link rel="stylesheet" href="{{ asset('star-admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('star-admin/images/favicon.png') }}" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                        <img src="{{ asset('star-admin/images/logo.svg') }}" alt="logo" />
                    </a>
                </div>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('star-admin/images/faces/face8.jpg') }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Management</li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="collapse" href="#skripsi-menu" aria-expanded="false"
                            aria-controls="skripsi-menu">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Skripsi</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse show" id="skripsi-menu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('skripsi.index') }}">Daftar Skripsi</a></li>
                                <li class="nav-item"> <a class="nav-link active" href="{{ route('skripsi.create') }}">Edit Skripsi</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Edit Skripsi</h4>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('skripsi.update', $skripsi) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="mahasiswa_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Mahasiswa --</option>
                                                @foreach($mahasiswas as $mahasiswa)
                                                    <option value="{{ $mahasiswa->id }}" @selected(old('mahasiswa_id', $skripsi->mahasiswa_id) == $mahasiswa->id)>
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
                                                    <option value="{{ $dosen->id }}" @selected(old('dosen_id', $skripsi->dosen_id) == $dosen->id)>
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
                                                value="{{ old('judul', $skripsi->judul) }}" placeholder="Masukkan judul skripsi" required>
                                            @error('judul')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                                rows="4" placeholder="Masukkan deskripsi skripsi" required>{{ old('deskripsi', $skripsi->deskripsi) }}</textarea>
                                            @error('deskripsi')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="pending" @selected(old('status', $skripsi->status) == 'pending')>Menunggu Persetujuan</option>
                                                <option value="ongoing" @selected(old('status', $skripsi->status) == 'ongoing')>Sedang Berjalan</option>
                                                <option value="completed" @selected(old('status', $skripsi->status) == 'completed')>Selesai</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="dokumen" class="form-label">Dokumen (PDF/DOC)</label>
                                            @if($skripsi->dokumen)
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($skripsi->dokumen) }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="mdi mdi-download"></i> Download Dokumen Lama
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" name="dokumen" id="dokumen" class="form-control @error('dokumen') is-invalid @enderror" 
                                                accept=".pdf,.docx,.doc">
                                            <small class="form-text text-muted">Format: PDF, DOCX, DOC (Max: 5MB). Biarkan kosong jika tidak ingin mengubah.</small>
                                            @error('dokumen')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-check"></i> Perbarui
                                            </button>
                                            <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">
                                                <i class="mdi mdi-close"></i> Batal
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Sistem Bimbingan Skripsi</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('star-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('star-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('star-admin/js/template.js') }}"></script>
</body>

</html>
