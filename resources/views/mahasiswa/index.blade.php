<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Daftar Mahasiswa</title>

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
                        <a class="nav-link active" data-bs-toggle="collapse" href="#mahasiswa-menu" aria-expanded="false"
                            aria-controls="mahasiswa-menu">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">Mahasiswa</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse show" id="mahasiswa-menu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link active" href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title">Daftar Mahasiswa</h4>
                                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                                            <i class="mdi mdi-plus"></i> Tambah Mahasiswa
                                        </a>
                                    </div>

                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-hover">
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
                                            <tbody>
                                                @forelse($mahasiswas as $mahasiswa)
                                                <tr>
                                                    <td>{{ $mahasiswas->firstItem() + $loop->index }}</td>
                                                    <td>{{ $mahasiswa->nama }}</td>
                                                    <td>{{ $mahasiswa->nim }}</td>
                                                    <td>{{ $mahasiswa->angkatan }}</td>
                                                    <td>{{ $mahasiswa->user->email }}</td>
                                                    <td>
                                                        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-sm btn-info">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
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

                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $mahasiswas->links() }}
                                    </div>
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
