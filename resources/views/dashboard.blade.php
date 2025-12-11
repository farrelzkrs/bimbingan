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
        <!-- Promo Banner -->
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
                    <div class="ps-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fw-medium me-3 buy-now-text">Welcome to Bimbingan Dashboard</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="ti-close text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">{{ Auth::user()->name }}</span></h1>
                        <h3 class="welcome-sub-text">Your performance summary this week</h3>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
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
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Activity</a>
                            <a class="dropdown-item" href="#"><i
                                    class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                FAQ</a>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
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
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">UI Elements</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="#">Buttons</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="#">Dropdowns</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="#">Typography</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab"
                                                href="#overview" role="tab" aria-controls="overview"
                                                aria-selected="true">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                href="#analytics" role="tab" aria-selected="false">Analytics</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                href="#reports" role="tab"
                                                aria-selected="false">Reports</a>
                                        </li>
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="#" class="btn btn-otline-dark align-items-center"><i
                                                    class="icon-share"></i> Share</a>
                                            <a href="#" class="btn btn-primary text-white me-0"><i
                                                    class="icon-download"></i> Export</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content tab-content-basic">
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div
                                                    class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Users</p>
                                                        <h3 class="rate-percentage">1,234</h3>
                                                        <p class="text-success d-flex"><i
                                                                class="mdi mdi-menu-up"></i><span>+2.5%</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">New Sessions</p>
                                                        <h3 class="rate-percentage">856</h3>
                                                        <p class="text-success d-flex"><i
                                                                class="mdi mdi-menu-up"></i><span>+0.5%</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Revenue</p>
                                                        <h3 class="rate-percentage">$45,320</h3>
                                                        <p class="text-success d-flex"><i
                                                                class="mdi mdi-menu-up"></i><span>+1.2%</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Active Projects</p>
                                                        <h3 class="rate-percentage">28</h3>
                                                        <p class="text-success d-flex"><i
                                                                class="mdi mdi-menu-up"></i><span>+0.8%</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div
                                                                    class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Welcome to Dashboard</h4>
                                                                        <p class="card-subtitle card-subtitle-dash">
                                                                            You're logged in to Bimbingan Dashboard. This is your main control panel where you can manage all your activities.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <p class="text-muted">Dashboard is currently using the Star Admin 2 template with a modern and clean design. Start by customizing this page with your content.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <h4 class="card-title card-title-dash mb-4">Quick Actions</h4>
                                                                <div class="list-wrapper pt-2">
                                                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                                                        <p class="mb-0 fw-medium">My Profile</p>
                                                                        <small><a href="{{ route('profile.edit') }}">View</a></small>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                                                        <p class="mb-0 fw-medium">Settings</p>
                                                                        <small><a href="#">View</a></small>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between py-2">
                                                                        <p class="mb-0 fw-medium">Support</p>
                                                                        <small><a href="#">Contact</a></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Analytics Tab -->
                                    <div class="tab-pane fade" id="analytics" role="tabpanel"
                                        aria-labelledby="analytics">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Analytics Content</h4>
                                                        <p class="text-muted">Your analytics data will appear here. Charts and statistics can be added to this section.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reports Tab -->
                                    <div class="tab-pane fade" id="reports" role="tabpanel"
                                        aria-labelledby="reports">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Reports Content</h4>
                                                        <p class="text-muted">Your reports will be displayed here. Generate and view various reports from this section.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{ config('app.name', 'Laravel') }} Dashboard</span>
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
