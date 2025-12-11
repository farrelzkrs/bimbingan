<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('star-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('star-admin/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('star-admin/images/favicon.png') }}" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- Navbar -->
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
                    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                        <img src="{{ asset('star-admin/images/logo-mini.svg') }}" alt="logo" />
                    </a>
                </div>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ Auth::user()->name }}</span></h1>
                        <h3 class="welcome-sub-text">Sistem Bimbingan Skripsi - Dashboard Anda</h3>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Cari di sini" title="Search here">
                        </form>
                    </li>

                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('star-admin/images/faces/face8.jpg') }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ asset('star-admin/images/faces/face8.jpg') }}"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil Saya</a>
                            <a class="dropdown-item" href="#"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Aktivitas</a>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item nav-category">Management</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#skripsi-menu" aria-expanded="false"
                            aria-controls="skripsi-menu">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Skripsi</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="skripsi-menu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('skripsi.index') }}">Daftar Skripsi</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('skripsi.create') }}">Tambah Skripsi</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#mahasiswa-menu" aria-expanded="false"
                            aria-controls="mahasiswa-menu">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">Mahasiswa</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="mahasiswa-menu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#dosen-menu" aria-expanded="false"
                            aria-controls="dosen-menu">
                            <i class="menu-icon mdi mdi-account-tie"></i>
                            <span class="menu-title">Dosen</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="dosen-menu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.index') }}">Daftar Dosen</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.create') }}">Tambah Dosen</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </nav>

            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <!-- Dashboard Content -->
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                        <!-- Statistics Row -->
                                        @if(Auth::user()->role === 'admin')
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div
                                                    class="statistics-details d-flex align-items-center justify-content-between flex-wrap">
                                                    <div>
                                                        <p class="statistics-title">Total Skripsi</p>
                                                        <h3 class="rate-percentage">{{ \App\Models\Skripsi::count() }}</h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Skripsi Berjalan</p>
                                                        <h3 class="rate-percentage">{{ \App\Models\Skripsi::where('status', 'ongoing')->count() }}</h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Mahasiswa</p>
                                                        <h3 class="rate-percentage">{{ \App\Models\Mahasiswa::count() }}</h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Dosen</p>
                                                        <h3 class="rate-percentage">{{ \App\Models\Dosen::count() }}</h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Skripsi Selesai</p>
                                                        <h3 class="rate-percentage">{{ \App\Models\Skripsi::where('status', 'completed')->count() }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Recent Skripsi -->
                                        <div class="row mt-4">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <h4 class="card-title card-title-dash">Skripsi Terbaru</h4>
                                                                <div class="table-responsive mt-4">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Mahasiswa</th>
                                                                                <th>Judul</th>
                                                                                <th>Dosen</th>
                                                                                <th>Status</th>
                                                                                <th>Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse(\App\Models\Skripsi::with(['mahasiswa', 'dosen'])->latest()->limit(5)->get() as $skripsi)
                                                                            <tr>
                                                                                <td>{{ $skripsi->mahasiswa->nama }}</td>
                                                                                <td>{{ Str::limit($skripsi->judul, 30) }}</td>
                                                                                <td>{{ $skripsi->dosen->nama }}</td>
                                                                                <td>
                                                                                    @if($skripsi->status === 'pending')
                                                                                        <span class="badge badge-warning">Menunggu</span>
                                                                                    @elseif($skripsi->status === 'ongoing')
                                                                                        <span class="badge badge-primary">Berjalan</span>
                                                                                    @else
                                                                                        <span class="badge badge-success">Selesai</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <a href="{{ route('skripsi.edit', $skripsi) }}" class="btn btn-sm btn-primary">Edit</a>
                                                                                </td>
                                                                            </tr>
                                                                            @empty
                                                                            <tr>
                                                                                <td colspan="5" class="text-center text-muted">Tidak ada data skripsi</td>
                                                                            </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quick Actions -->
                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <h4 class="card-title card-title-dash mb-4">Aksi Cepat</h4>
                                                                <div class="list-wrapper pt-2">
                                                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                                                        <p class="mb-0 fw-medium">Kelola Skripsi</p>
                                                                        <small><a href="{{ route('skripsi.index') }}">Buka</a></small>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                                                        <p class="mb-0 fw-medium">Kelola Mahasiswa</p>
                                                                        <small><a href="{{ route('mahasiswa.index') }}">Buka</a></small>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                                                        <p class="mb-0 fw-medium">Kelola Dosen</p>
                                                                        <small><a href="{{ route('dosen.index') }}">Buka</a></small>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between py-2">
                                                                        <p class="mb-0 fw-medium">Profil Saya</p>
                                                                        <small><a href="{{ route('profile.edit') }}">Edit</a></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <!-- Dashboard untuk Mahasiswa -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Skripsi Saya</h4>
                                                        @if(Auth::user()->mahasiswa && Auth::user()->mahasiswa->skripsi)
                                                            @php
                                                                $skripsi = Auth::user()->mahasiswa->skripsi;
                                                            @endphp
                                                            <div class="row mt-4">
                                                                <div class="col-md-8">
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Judul Skripsi</label>
                                                                        <p>{{ $skripsi->judul }}</p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Deskripsi</label>
                                                                        <p>{{ $skripsi->deskripsi }}</p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Dosen Pembimbing</label>
                                                                        <p>{{ $skripsi->dosen->nama }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card bg-light">
                                                                        <div class="card-body">
                                                                            <h6 class="card-title">Status Skripsi</h6>
                                                                            @if($skripsi->status === 'pending')
                                                                                <span class="badge badge-warning badge-lg">Menunggu Persetujuan</span>
                                                                            @elseif($skripsi->status === 'ongoing')
                                                                                <span class="badge badge-primary badge-lg">Sedang Berjalan</span>
                                                                            @else
                                                                                <span class="badge badge-success badge-lg">Selesai</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <p class="text-muted">Anda belum memiliki skripsi. Hubungi dosen pembimbing untuk membuat skripsi baru.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Sistem Bimbingan Skripsi</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © {{ date('Y') }}. All rights reserved.</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('star-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('star-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('star-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('star-admin/js/template.js') }}"></script>
    <script src="{{ asset('star-admin/js/settings.js') }}"></script>
    <script src="{{ asset('star-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('star-admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('star-admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End custom js for this page-->
</body>

</html>
