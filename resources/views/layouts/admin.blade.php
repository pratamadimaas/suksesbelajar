
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title', 'Dashboard')</title>
    
    <!-- Google Fonts: Poppins for a modern, clean look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
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
        
        /* Mobile Header */
        .mobile-header {
            background-color: #1a202c;
            color: white;
            padding: 1rem;
            display: none;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background-color: #1a202c;
            color: #e2e8f0;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: -100%;
            width: 280px;
            z-index: 1050;
        }
        
        .sidebar.show {
            left: 0;
        }
        
        /* Desktop Sidebar */
        @media (min-width: 768px) {
            .sidebar {
                position: relative;
                left: 0;
                width: auto;
            }
            .mobile-header {
                display: none !important;
            }
        }
        
        /* Mobile Styles */
        @media (max-width: 767px) {
            .mobile-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .main-content {
                margin: 1rem;
            }
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        
        .sidebar-overlay.show {
            display: block;
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
            background-color: #4c51bf;
            color: #fff;
            font-weight: 500;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .sidebar .nav-link i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
        }
        .main-content {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
        
        /* Close button for mobile sidebar */
        .sidebar-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: #e2e8f0;
            font-size: 1.5rem;
            display: none;
        }
        
        @media (max-width: 767px) {
            .sidebar-close {
                display: block;
            }
        }
        
        /* Hamburger menu button */
        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Header -->
    <div class="mobile-header d-md-none">
        <div class="d-flex align-items-center">
            <button class="menu-toggle me-3" type="button" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Admin Bimbel</h5>
        </div>
        <small class="text-muted">{{ Auth::user()->name }}</small>
    </div>
    
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="closeSidebar()"></div>
    
    <div class="container-fluid admin-container">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <button class="sidebar-close" onclick="closeSidebar()">
                    <i class="bi bi-x-lg"></i>
                </button>
                
                <div class="position-sticky pt-3">
                    <div class="sidebar-header text-center">
                        <h5 class="mb-1">Admin Bimbel</h5>
                        <small class="text-muted d-none d-md-block">{{ Auth::user()->name }}</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}" onclick="closeSidebar()">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" 
                               href="{{ route('admin.users.index') }}" onclick="closeSidebar()">
                                <i class="bi bi-person-badge-fill"></i>
                                Manajemen Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.soal*') ? 'active' : '' }}" 
                               href="{{ route('admin.soal.index') }}" onclick="closeSidebar()">
                                <i class="bi bi-question-circle"></i>
                                Soal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.paket*') ? 'active' : '' }}" 
                               href="{{ route('admin.paket.index') }}" onclick="closeSidebar()">
                                <i class="bi bi-box"></i>
                                Paket Ujian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}" 
                               href="{{ route('admin.laporan.index') }}" onclick="closeSidebar()">
                                <i class="bi bi-bar-chart"></i>
                                Laporan
                            </a>
                        </li>
                    </ul>
                    
                    <div class="sidebar-header mt-4">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link text-start w-100">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Mobile sidebar functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            
            // Prevent body scroll when sidebar is open
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
        
        // Close sidebar when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeSidebar();
            }
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) && 
                sidebar.classList.contains('show')) {
                closeSidebar();
            }
        });
    </script>
    
    @stack('scripts')
    
    <!-- Example Dashboard Content -->
    <style>
        .dashboard-card {
            border-radius: 1rem;
            padding: 1.5rem;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        .dashboard-card .card-icon {
            font-size: 2.5rem;
            margin-right: 1rem;
            opacity: 0.8;
        }
        .dashboard-card .card-content {
            text-align: right;
        }
        .dashboard-card .card-label {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .dashboard-card .card-value {
            margin: 0;
            font-size: 2.25rem;
            font-weight: 600;
        }
        .primary-gradient {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }
        .success-gradient {
            background: linear-gradient(45deg, #28a745, #1e7e34);
        }
        .warning-gradient {
            background: linear-gradient(45deg, #ffc107, #d39e00);
        }
        .danger-gradient {
            background: linear-gradient(45deg, #dc3545, #b82c39);
        }
        .g-4 {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 1.5rem;
        }
        
        /* Mobile optimizations for dashboard cards */
        @media (max-width: 767px) {
            .dashboard-card {
                padding: 1rem;
                flex-direction: column;
                text-align: center;
            }
            .dashboard-card .card-icon {
                margin-right: 0;
                margin-bottom: 0.5rem;
                font-size: 2rem;
            }
            .dashboard-card .card-content {
                text-align: center;
            }
            .dashboard-card .card-value {
                font-size: 1.75rem;
            }
        }
    </style>
