<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siswa - @yield('title', 'Dashboard')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --primary-light: #d1fae5;
            --accent: #f97316;
            --dark: #1f2937;
            --gray: #6b7280;
            --light-gray: #f9fafb;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: var(--white);
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            color: var(--gray) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            border-bottom: 2px solid var(--primary);
        }

        .navbar-nav .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 2rem 0;
        }

        /* Alerts */
        .alert {
            border-radius: 0.5rem;
        }

        /* Footer */
        .footer {
            background-color: var(--dark);
            color: var(--light-gray);
        }

        .footer a {
            color: var(--accent);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .btn-primary-custom {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            color: var(--white);
        }

        .btn-accent {
            background-color: var(--accent);
            color: var(--white);
            border: none;
        }

        .btn-accent:hover {
            opacity: 0.9;
            color: var(--white);
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book-half me-2"></i>
                SuksesBelajar
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('siswa.materi*') ? 'active' : '' }}" href="{{ route('siswa.materi.index') }}">
                            Materi Ajar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ujian.show') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
                            Paket Ujian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ujian.leaderboard') ? 'active' : '' }}" href="{{ route('ujian.leaderboard') }}">
                            Leaderboard
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('siswa.profile') }}">Profil Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-primary-custom px-3 py-1" href="{{ route('login.form') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if (session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer py-4">
        <div class="container text-center">
            <p class="m-0">&copy; {{ date('Y') }} SuksesBelajar. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] =
            document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    @stack('scripts')
</body>
</html>
