<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuksesBelajar - Platform Edukasi CPNS Terdepan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #0d9488;
            --primary-light: #d1fae5;
            --primary-ultra-light: #ecfeff;
            --accent: #3b82f6;
            --accent-dark: #2563eb;
            --accent-light: #dbeafe;
            --dark: #1e293b;
            --gray: #64748b;
            --light-gray: #f8fafc;
            --white: #ffffff;
            --gradient-primary: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
            --gradient-accent: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            --gradient-hero: linear-gradient(135deg, #ecfeff 0%, #d1fae5 50%, #dbeafe 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        /* Navbar dengan desain floating modern */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            padding: 1rem 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 0.7rem 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark) !important;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.03);
        }
        
        .brand-logo {
            width: 42px;
            height: 42px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }
        
        .nav-link {
            color: var(--gray) !important;
            font-weight: 600;
            padding: 0.6rem 1.2rem !important;
            transition: all 0.3s ease;
            border-radius: 8px;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 80%;
            height: 2px;
            background: var(--gradient-primary);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: var(--primary-ultra-light);
        }

        .nav-link:hover::after {
            transform: translateX(-50%) scaleX(1);
        }

        /* Hero Section dengan desain unik */
        .hero-section {
            background: var(--gradient-hero);
            padding: 160px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(30px, -30px) rotate(5deg); }
            50% { transform: translate(-20px, 20px) rotate(-5deg); }
            75% { transform: translate(20px, 30px) rotate(3deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-title .highlight {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 2.5rem;
            max-width: 580px;
        }

        .btn-cta {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 16px 36px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
            font-size: 1.05rem;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(16, 185, 129, 0.4);
            color: var(--white);
        }

        .btn-cta:active {
            transform: translateY(-1px);
        }

        .hero-visual {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .visual-container {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .visual-card {
            background: var(--white);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .visual-icon {
            width: 120px;
            height: 120px;
            background: var(--gradient-primary);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 4rem;
            box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);
        }

        .visual-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            width: 100%;
        }

        .stat-item {
            background: var(--light-gray);
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 600;
        }

        /* Section Styling dengan spacing lebih baik */
        .section {
            padding: 100px 0;
        }

        .section-alt {
            background: var(--light-gray);
        }

        .section-header {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--accent-light);
            color: var(--accent);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1.2rem;
            letter-spacing: -0.01em;
        }

        .section-description {
            font-size: 1.15rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Feature Cards dengan hover effect menarik */
        .feature-card {
            background: var(--white);
            border: 2px solid transparent;
            border-radius: 20px;
            padding: 40px 32px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover {
            border-color: var(--primary-light);
            box-shadow: 0 16px 48px rgba(16, 185, 129, 0.12);
            transform: translateY(-8px);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 2rem;
            margin-bottom: 24px;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .feature-text {
            color: var(--gray);
            font-size: 1rem;
            line-height: 1.7;
            margin: 0;
        }

        /* Package Cards dengan desain premium */
        .package-card {
            background: var(--white);
            border: 2px solid #e5e7eb;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .package-card:hover {
            border-color: var(--primary);
            box-shadow: 0 20px 60px rgba(16, 185, 129, 0.15);
            transform: translateY(-12px);
        }

        .package-card:hover::before {
            opacity: 1;
        }

        .package-header {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .package-name {
            font-weight: 800;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .package-badge {
            background: var(--accent);
            color: var(--white);
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .package-desc {
            opacity: 0.95;
            margin: 0;
            font-weight: 500;
        }

        .package-body {
            padding: 36px 30px;
            flex-grow: 1;
            position: relative;
            z-index: 2;
        }

        .package-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .package-features li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
            color: var(--gray);
            font-size: 1rem;
            font-weight: 500;
        }

        .package-features li i {
            font-size: 1.3rem;
            color: var(--primary);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .package-footer {
            padding: 0 30px 36px;
            position: relative;
            z-index: 2;
        }

        .btn-package {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            display: block;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            background: var(--white);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--gradient-primary);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
        }

        .btn-solid {
            background: var(--gradient-primary);
            color: var(--white);
            border: none;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
        }

        .btn-solid:hover {
            background: var(--gradient-accent);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3);
        }

        /* Testimonial Cards dengan desain fresh */
        .testimonial-card {
            background: var(--white);
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            padding: 36px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 6rem;
            color: var(--primary-light);
            font-family: Georgia, serif;
            line-height: 1;
            opacity: 0.5;
        }

        .testimonial-card:hover {
            border-color: var(--primary);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
            transform: translateY(-6px);
        }

        .testimonial-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 28px;
            position: relative;
            z-index: 2;
        }

        .testimonial-author {
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            z-index: 2;
        }

        .author-stars {
            color: #fbbf24;
            font-size: 1rem;
        }

        .author-name {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            font-size: 1.1rem;
        }

        .author-role {
            font-size: 0.9rem;
            color: var(--accent);
            margin: 0;
            font-weight: 600;
        }

        /* CTA Section dengan desain eye-catching */
        .cta-section {
            background: var(--gradient-primary);
            padding: 100px 0;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -25%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -25%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.01em;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.95;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .btn-cta-white {
            background: var(--white);
            color: var(--primary);
            padding: 18px 40px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            font-size: 1.1rem;
        }

        .btn-cta-white:hover {
            background: var(--accent);
            color: var(--white);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
        }

        /* Footer dengan desain modern */
        .footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #94a3b8;
            padding: 80px 0 30px;
            position: relative;
        }

        .footer h5 {
            color: var(--white);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-text {
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .social-icons a {
            display: inline-flex;
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            color: var(--white);
            margin-right: 12px;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .social-icons a:hover {
            background: var(--gradient-primary);
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 2rem;
        }

        .footer-bottom a {
            color: #94a3b8;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }

            .cta-title {
                font-size: 2.2rem;
            }

            .btn-cta-white {
                margin: 10px 0;
                width: 100%;
                justify-content: center;
            }

            .visual-card {
                padding: 2rem;
            }

            .visual-icon {
                width: 100px;
                height: 100px;
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="brand-logo">
                    <i class="bi bi-book-half"></i>
                </div>
                SuksesBelajar
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#paket-ujian">Paket Ujian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni">Testimoni</a>
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
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.form') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section id="beranda" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Wujudkan Karier Impian <span class="highlight">ASN</span> Bersama Kami</h1>
                    <p class="hero-subtitle">
                        Belajar lebih terarah dengan latihan soal terbaru, pembahasan detail, dan simulasi ujian interaktif. 
                        Persiapkan dirimu menghadapi seleksi CPNS dengan strategi yang tepat dan efektif.
                    </p>
                    <a href="https://chat.whatsapp.com/G2ftAKsCWvDDhk1SLaH38U?mode=ems_copy_t" class="btn-cta">
                        <i class="bi bi-whatsapp"></i>
                        Gabung Grup Belajar Gratis
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="visual-container">
                            <div class="visual-card">
                                <div class="visual-icon">
                                    <i class="bi bi-book-half"></i>
                                </div>
                                <div class="visual-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">15K+</div>
                                        <div class="stat-label">Peserta Aktif</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">98%</div>
                                        <div class="stat-label">Tingkat Kepuasan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="section section-alt">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="bi bi-star-fill"></i>
                    Keunggulan Platform
                </div>
                <h2 class="section-title">Mengapa Memilih SuksesBelajar?</h2>
                <p class="section-description">
                    Tempat belajar online dengan materi terbaru, latihan soal interaktif, 
                    dan bimbingan mentor berpengalaman untuk persiapan CPNS yang lebih terarah.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h3 class="feature-title">Metode Cerdas</h3>
                        <p class="feature-text">
                            Pembelajaran yang menyesuaikan kemampuan dan perkembangan tiap peserta secara personal.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        <h3 class="feature-title">Evaluasi Lengkap</h3>
                        <p class="feature-text">
                            Laporan detail tentang keunggulan dan kelemahan Anda, lengkap dengan saran strategi belajar yang tepat.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h3 class="feature-title">Motivasi & Tantangan</h3>
                        <p class="feature-text">
                            Ikuti leaderboard dan kompetisi seru untuk meningkatkan semangat belajar bersama.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h3 class="feature-title">Belajar Fleksibel</h3>
                        <p class="feature-text">
                            Akses materi dan soal kapan saja, di mana saja, 24/7 tanpa batas.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="feature-title">Tim Ahli</h3>
                        <p class="feature-text">
                            Didukung mentor berpengalaman yang memahami strategi lolos seleksi CPNS.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <h3 class="feature-title">Soal Berkualitas</h3>
                        <p class="feature-text">
                            Bank soal selalu update dan sesuai tren terbaru seleksi CPNS.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="paket-ujian" class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="bi bi-box-seam"></i>
                    Pilihan Paket
                </div>
                <h2 class="section-title">Paket Tryout Beragam</h2>
                <p class="section-description">
                    Uji kemampuan dengan pilihan paket tryout sesuai kebutuhan persiapan Anda.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-badge">Gratis</div>
                            <h3 class="package-name">Paket Basic</h3>
                            <p class="package-desc">Cocok untuk pemula</p>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>1x Try Out</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Dilengkapi Pembahasan</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Akses Leaderboard Nasional</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Grup Belajar Bersama (Free)</span>
                                </li>
                                <li>
                                    <i class="bi bi-clock-fill"></i>
                                    <span>100 menit durasi</span>
                                </li>
                            </ul>
                        </div>
                        <div class="package-footer">
                            <a href="https://wa.me/6283879373233" class="btn-package btn-outline">Mulai Gratis</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-badge">Populer</div>
                            <h3 class="package-name">Paket Standard</h3>
                            <p class="package-desc">Persiapan menyeluruh</p>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>10x Try Out Lengkap</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Dilengkapi Pembahasan</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Akses Leaderboard Nasional</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Grup Belajar Bersama (Standard)</span>
                                </li>
                                <li>
                                    <i class="bi bi-clock-fill"></i>
                                    <span>100 menit per sesi</span>
                                </li>
                            </ul>
                        </div>
                        <div class="package-footer">
                            <a href="https://wa.me/6283879373233" class="btn-package btn-solid">Pilih Paket</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-badge">Terbaik</div>
                            <h3 class="package-name">Paket Premium</h3>
                            <p class="package-desc">Persiapan maksimal</p>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>20x Try Out Lengkap</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Dilengkapi Pembahasan</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Akses Leaderboard Nasional</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Grup Belajar Bersama (Premium)</span>
                                </li>
                                <li>
                                    <i class="bi bi-clock-fill"></i>
                                    <span>100 menit per sesi</span>
                                </li>
                            </ul>
                        </div>
                        <div class="package-footer">
                            <a href="https://wa.me/6283879373233" class="btn-package btn-solid">Pilih Premium</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="section section-alt">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="bi bi-chat-quote"></i>
                    Testimoni
                </div>
                <h2 class="section-title">Apa Kata Mereka Tentang SuksesBelajar?</h2>
                <p class="section-description">
                    Ribuan siswa telah merasakan manfaat platform pembelajaran kami dan berhasil lulus tes CPNS dengan hasil memuaskan.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            Platform ini benar-benar membantu. Soalnya mirip dengan ujian asli, analisisnya detail, dan sangat berguna.
                        </p>
                        <div class="testimonial-author">
                            <div class="author-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="author-name">Hafid</p>
                            <p class="author-role">Lulus CPNS 2024</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            Sistem adaptif membuat saya belajar sesuai kemampuan. Mentor juga suportif dan berpengalaman.
                        </p>
                        <div class="testimonial-author">
                            <div class="author-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="author-name">Uya</p>
                            <p class="author-role">Lulus CPNS 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            Saya bisa belajar kapan pun meski bekerja penuh waktu. Fleksibel, tapi tetap berkualitas tinggi.
                        </p>
                        <div class="testimonial-author">
                            <div class="author-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="author-name">Alam</p>
                            <p class="author-role">Lulus CPNS 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Siap Memulai Perjalanan Menuju Sukses?</h2>
                <p class="cta-description">
                    Bergabunglah dengan ribuan calon PNS lainnya dan raih impian Anda bersama platform pembelajaran terdepan di Indonesia.
                </p>
                <a href="https://wa.me/6283879373233" class="btn-cta-white">
                    <i class="bi bi-rocket-takeoff"></i>
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>
                        <i class="bi bi-book-half"></i>
                        SuksesBelajar
                    </h5>
                    <p class="footer-text">
                        Platform pembelajaran online terdepan untuk persiapan tes CPNS dengan sistem yang komprehensif dan terintegrasi.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Tryout Online</a></li>
                        <li><a href="#">Bank Soal</a></li>
                        <li><a href="#">Mentoring</a></li>
                        <li><a href="#">Analisis Hasil</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Perusahaan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Bantuan</h5>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Panduan</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Kebijakan</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Kontak</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-telephone"></i> +6283879373233</li>
                        <li><i class="bi bi-envelope"></i> masukcpns5@gmail.com</li>
                        <li><i class="bi bi-geo-alt"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; 2025 SuksesBelajar. Hak cipta dilindungi undang-undang.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <a href="#">Syarat & Ketentuan</a>
                        <a href="#">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu close on link click
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('#navbarNav');
                
                if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
        });

        // Intersection Observer for animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.feature-card, .package-card, .testimonial-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>