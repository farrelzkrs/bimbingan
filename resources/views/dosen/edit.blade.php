<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Edit Dosen</title>

    <link rel="stylesheet" href="{{ asset('star-admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/css/style.css') }}">
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
        </nav>

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel" style="margin-left: 0; width: 100%;">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card mt-5">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Edit Dosen</h4>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('dosen.update', $dosen) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                                                value="{{ old('nama', $dosen->nama) }}" required>
                                            @error('nama')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" 
                                                value="{{ old('nip', $dosen->nip) }}" required>
                                            @error('nip')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="spesialisasi" class="form-label">Spesialisasi</label>
                                            <input type="text" name="spesialisasi" id="spesialisasi" class="form-control @error('spesialisasi') is-invalid @enderror" 
                                                value="{{ old('spesialisasi', $dosen->spesialisasi) }}">
                                            @error('spesialisasi')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Perbarui</button>
                                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('star-admin/vendors/js/vendor.bundle.base.js') }}"></script>
</body>

</html>
