<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title', 'Dashboard')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }
        .admin-container {
            min-height: 100vh;
        }
        .sidebar {
            background-color: #1a202c; /* Dark blue/gray */
            color: #e2e8f0;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            transition: width 0.3s ease;
        }
        .sidebar-header {
            border-bottom: 1px solid #2d3748;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .sidebar-header h5 {
            color: #fff;
            font-weight: 600;
        }
        .sidebar .nav-link {
            color: #cbd5e0;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: background-color 0.2s, color 0.2s;
        }
        .sidebar .nav-link:hover {
            background-color: #2d3748;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: #4c51bf; /* Modern blue active */
            color: #fff;
            font-weight: 500;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                        0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .sidebar .nav-link i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
        }
        .main-content {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                        0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin: 1.5rem;
        }
        .content-header {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .content-header h1 {
            font-weight: 700;
            color: #2d3748;
        }
        .alert {
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        /* Responsive */
        @media (max-width: 767.98px) {
            .sidebar.collapse:not(.show) {
                display: none;
            }
            .sidebar.collapse.show {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1050;
                width: 100%;
                max-width: 300px;
                height: 100%;
                overflow-y: auto;
            }
            .main-content {
                margin: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="container-fluid admin-container">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="sidebar-header text-center">
                        <h5 class="mb-1">Admin Bimbel</h5>
                        <small class="text-muted">{{ Auth::user()->name }}</small>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" 
                               href="{{ route('admin.users.index') }}">
                                <i class="bi bi-person-badge-fill"></i> Manajemen Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.soal*') ? 'active' : '' }}" 
                               href="{{ route('admin.soal.index') }}">
                                <i class="bi bi-question-circle"></i> Soal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.paket*') ? 'active' : '' }}" 
                               href="{{ route('admin.paket.index') }}">
                                <i class="bi bi-box"></i> Paket Ujian
                            </a>
                        </li>
                        <!-- Materi Ajar -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.materi*') ? 'active' : '' }}" 
                               href="{{ route('admin.materi.index') }}">
                                <i class="bi bi-journal-text"></i> Materi Ajar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}" 
                               href="{{ route('admin.laporan.index') }}">
                                <i class="bi bi-bar-chart"></i> Laporan
                            </a>
                        </li>
                    </ul>

                    <div class="sidebar-header mt-4">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link text-start w-100">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Mobile Navbar -->
                <nav class="navbar navbar-light bg-white border-bottom d-md-none fixed-top shadow-sm">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand text-dark fw-bold ms-auto me-auto" href="#">Admin Bimbel</a>
                    </div>
                </nav>

                <!-- Content -->
                <div class="main-content">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center content-header">
                        <h1 class="h2">@yield('title', 'Dashboard')</h1>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = 
            document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    @stack('scripts')
</body>
</html>
