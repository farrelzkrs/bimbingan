<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat-admin/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Sistem Bimbingan Skripsi</title>
    <meta name="description" content="Sistem Bimbingan Skripsi" />
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat-admin/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('sneat-admin/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat-admin/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')

            <div class="layout-page">
                @include('layouts.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Selamat Datang, {{ auth()->user()->name }}!</h5>
                                        <p class="text-muted mb-0">
                                            @if(auth()->user()->role === 'admin')
                                                Anda login sebagai <strong>Administrator (Dosen)</strong>. Kelola semua data sistem termasuk mahasiswa, dosen, dan skripsi.
                                            @else
                                                Anda login sebagai <strong>Mahasiswa</strong>. Lihat informasi skripsi Anda dan pantau perkembangannya.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="d-block small fw-semibold text-muted text-uppercase mb-2">Total Skripsi</span>
                                                <h3 class="mb-0">{{ App\Models\Skripsi::count() }}</h3>
                                            </div>
                                            <div class="ps-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-book"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="d-block small fw-semibold text-muted text-uppercase mb-2">Skripsi Berjalan</span>
                                                <h3 class="mb-0">{{ App\Models\Skripsi::where('status', 'ongoing')->count() }}</h3>
                                            </div>
                                            <div class="ps-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="d-block small fw-semibold text-muted text-uppercase mb-2">Skripsi Selesai</span>
                                                <h3 class="mb-0">{{ App\Models\Skripsi::where('status', 'completed')->count() }}</h3>
                                            </div>
                                            <div class="ps-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="d-block small fw-semibold text-muted text-uppercase mb-2">Total Mahasiswa</span>
                                                <h3 class="mb-0">{{ App\Models\Mahasiswa::count() }}</h3>
                                            </div>
                                            <div class="ps-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="d-block small fw-semibold text-muted text-uppercase mb-2">Total Dosen</span>
                                                <h3 class="mb-0">{{ App\Models\Dosen::count() }}</h3>
                                            </div>
                                            <div class="ps-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-user-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h5 class="mb-0">Skripsi Terbaru</h5>
                                    </div>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Judul Terbaru</th>
                                                    <th>Mahasiswa</th>
                                                    <th>Dosen</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @forelse(App\Models\Skripsi::latest()->limit(5)->get() as $skripsi)
                                                    <tr>
                                                        <td><strong>{{ Str::limit($skripsi->judul, 30) }}</strong></td>
                                                        <td>{{ $skripsi->mahasiswa->nama }}</td>
                                                        <td>{{ $skripsi->dosen->nama }}</td>
                                                        <td>
                                                            @if($skripsi->status === 'pending')
                                                                <span class="badge bg-label-secondary">Menunggu</span>
                                                            @elseif($skripsi->status === 'ongoing')
                                                                <span class="badge bg-label-warning">Berjalan</span>
                                                            @else
                                                                <span class="badge bg-label-success">Selesai</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('skripsi.show', $skripsi->id) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="Lihat">
                                                                <i class="bx bx-show"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-3">Belum ada data skripsi</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('layouts.footer')
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset('sneat-admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('sneat-admin/js/main.js') }}"></script>
    <script src="{{ asset('sneat-admin/js/dashboards-analytics.js') }}"></script>
</body>

</html>
