<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk CPNS - Sistem Ujian Online</title>
    
    <!-- Google Fonts: Poppins for a modern, clean look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        
        .navbar-brand {
            color: #1e3a8a !important;
            font-weight: 700;
        }
        
        .navbar-nav .nav-link {
            color: #4b5563 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: #1e3a8a !important;
        }

        .navbar-nav .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff" fill-opacity="0.05" points="0,1000 1000,0 1000,1000"/></svg>');
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .btn-hero {
            background: white;
            color: #1e3a8a;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            color: #1e3a8a;
        }

        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border-color: #3b82f6;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
        }

        .testimonial-section {
            padding: 80px 0;
            background: white;
        }

        .testimonial-card {
            background: #f9fafb;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 4px solid #3b82f6;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: #4b5563;
            font-size: 1.1rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: #1e3a8a;
        }

        .cta-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .footer {
            background-color: #1f2937;
            color: #e5e7eb;
            padding: 50px 0 30px;
        }

        .footer-section h5 {
            color: white;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #3b82f6;
        }

        .card-paket {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-paket:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-paket .card-header {
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            color: white;
            border: none;
            padding: 25px;
        }

        .pricing-badge {
            background: #10b981;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>
                Masuk CPNS
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
                        <a class="nav-link" href="#paket-ujian">Paket Ujian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
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
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Raih Mimpi Jadi PNS Bersama Kami</h1>
                    <p class="hero-subtitle">
                        Platform pembelajaran online terlengkap untuk persiapan tes CPNS. 
                        Dengan ribuan soal berkualitas dan sistem evaluasi yang akurat.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                    <a href="https://chat.whatsapp.com/G2ftAKsCWvDDhk1SLaH38U?mode=ems_copy_t" class="btn btn-hero">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Join Grup Belajar Bersama (Gratis)
                    </a>
                </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <i class="bi bi-mortarboard display-1" style="font-size: 12rem; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="tentang" class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Mengapa Memilih Masuk CPNS Kami?</h2>
                    <p class="lead text-muted">
                        Kami menyediakan platform pembelajaran yang komprehensif dan terintegrasi 
                        untuk mempersiapkan Anda menghadapi tes CPNS dengan percaya diri.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sistem Adaptif</h4>
                        <p class="text-muted">
                            Sistem pembelajaran yang menyesuaikan dengan tingkat kemampuan 
                            dan progress belajar setiap siswa secara personal.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Analisis Mendalam</h4>
                        <p class="text-muted">
                            Dapatkan laporan detail tentang kekuatan dan kelemahan Anda 
                            dengan rekomendasi pembelajaran yang tepat sasaran.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kompetisi Sehat</h4>
                        <p class="text-muted">
                            Berpartisipasi dalam leaderboard dan tantangan untuk 
                            memotivasi diri dan berkompetisi dengan sesama peserta.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Fleksibel</h4>
                        <p class="text-muted">
                            Belajar kapan saja dan dimana saja dengan akses 24/7 
                            ke semua materi dan latihan soal yang tersedia.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Mentor Berpengalaman</h4>
                        <p class="text-muted">
                            Didampingi oleh tim mentor yang berpengalaman dan 
                            ahli di bidang tes CPNS dengan track record terbukti.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kualitas Terjamin</h4>
                        <p class="text-muted">
                            Soal-soal berkualitas tinggi yang selalu update 
                            mengikuti perkembangan terbaru format tes CPNS.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Ujian Section -->
    <section id="paket-ujian" class="py-5" style="background-color: #f9fafb;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Pilihan Paket Ujian</h2>
                    <p class="lead text-muted">
                        Uji kemampuan Anda dengan berbagai paket soal Tryout CPNS yang tersedia.
                        Pilih paket yang sesuai dengan kebutuhan persiapan Anda!
                    </p>
                </div>
            </div>

            <div class="row g-4">
               <!-- Paket Basic -->
<div class="col-lg-4 col-md-6">
    <div class="card card-paket">
        <div class="card-header text-center">
            <h4 class="fw-bold mb-2">Paket Basic</h4>
            <div class="pricing-badge mb-3">Gratis</div>
            <p class="mb-0">Cocok untuk pemula</p>
        </div>
        <div class="card-body p-4">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>1x Try Out</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Dilengkapi Pembahasan</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Akses Leaderboard Nasional</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock-fill text-info me-2"></i>
                    <span>100 menit durasi</span>
                </li>
            </ul>
        </div>
        <div class="card-footer bg-white border-0">
            <a href="https://wa.me/6283879373233" class="btn btn-outline-primary w-100">Mulai Gratis</a>
        </div>
    </div>
</div>


<!-- Paket Standard -->
<div class="col-lg-4 col-md-6">
    <div class="card card-paket">
        <div class="card-header text-center">
            <h4 class="fw-bold mb-2">Paket Standard</h4>
            <div class="pricing-badge mb-3">Populer</div>
            <p class="mb-0">Persiapan menyeluruh</p>
        </div>
        <div class="card-body p-4">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>10x Try Out Lengkap</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Dilengkapi Pembahasan</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Modul Belajar Eksklusif</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Akses Leaderboard Nasional</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock-fill text-info me-2"></i>
                    <span>100 menit per sesi</span>
                </li>
            </ul>
        </div>
        <div class="card-footer bg-white border-0">
            <a href="https://wa.me/6283879373233" class="btn btn-primary w-100">Pilih Paket</a>
        </div>
    </div>
</div>

<!-- Paket Premium -->
<div class="col-lg-4 col-md-6">
    <div class="card card-paket">
        <div class="card-header text-center">
            <h4 class="fw-bold mb-2">Paket Premium</h4>
            <div class="pricing-badge mb-3">Terbaik</div>
            <p class="mb-0">Persiapan maksimal</p>
        </div>
        <div class="card-body p-4">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>20x Try Out Lengkap</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Dilengkapi Pembahasan</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Modul Belajar Lengkap</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <span>Akses Leaderboard Nasional</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock-fill text-info me-2"></i>
                    <span>100 menit per sesi</span>
                </li>
            </ul>
        </div>
        <div class="card-footer bg-white border-0">
            <a href="https://wa.me/6283879373233" class="btn btn-primary w-100">Pilih Premium</a>
        </div>
    </div>
</div>

    </section>

    <!-- Testimonial Section -->
    <section id="testimoni" class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Kata Mereka Tentang Kami</h2>
                    <p class="lead text-muted">
                        Ribuan siswa telah merasakan manfaat platform pembelajaran kami 
                        dan berhasil lulus tes CPNS dengan hasil memuaskan.
                    </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "Platform yang sangat membantu! Soal-soalnya berkualitas dan mirip dengan tes CPNS asli. 
                            Analisis hasil yang detail membuat saya tahu dimana kelemahan saya."
                        </div>
                        <div class="testimonial-author">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-3"></i>
                            Hafid - Lulus CPNS 2024
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "Sistem pembelajaran yang adaptif benar-benar membantu saya belajar sesuai kemampuan. 
                            Mentornya juga sangat supportif dan berpengalaman."
                        </div>
                        <div class="testimonial-author">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-3"></i>
                            Uya - Lulus CPNS 2024
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "Fleksibilitas waktu belajar sangat membantu saya yang bekerja. 
                            Bisa belajar kapan saja dan dimana saja dengan kualitas yang tetap terjaga."
                        </div>
                        <div class="testimonial-author">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-3"></i>
                            Alam - Lulus CPNS 2024
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3">Siap Memulai Perjalanan Menuju Sukses?</h2>
                    <p class="lead mb-4">
                        Bergabunglah dengan ribuan calon PNS lainnya dan raih impian Anda 
                        bersama platform pembelajaran terdepan di Indonesia.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#daftar" class="btn btn-light btn-lg">
                            <i class="bi bi-person-plus me-2"></i>
                            Daftar Sekarang
                        </a>
                        <a href="#paket-ujian" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-eye me-2"></i>
                            Lihat Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-section">
                        <h5>
                            <i class="bi bi-mortarboard-fill me-2"></i>
                            Masuk CPNS
                        </h5>
                        <p>
                            Platform pembelajaran online terdepan untuk persiapan tes CPNS 
                            dengan sistem yang komprehensif dan terintegrasi.
                        </p>
                        <div class="social-links">
                            <a href="#" class="me-3"><i class="bi bi-facebook fs-4"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-twitter fs-4"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-instagram fs-4"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-youtube fs-4"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Layanan</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Tryout Online</a></li>
                            <li><a href="#">Bank Soal</a></li>
                            <li><a href="#">Mentoring</a></li>
                            <li><a href="#">Analisis Hasil</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Perusahaan</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Karir</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Bantuan</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Panduan</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Kebijakan</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Kontak</h5>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-telephone me-2"></i>+6283879373233</li>
                            <li><i class="bi bi-envelope me-2"></i>masukcpns5@gmail.com</li>
                            <li><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Masuk CPNS. Hak cipta dilindungi undang-undang.</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="me-3">Syarat & Ketentuan</a>
                    <a href="#">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Handle logout functionality
        function handleLogout(event) {
            event.preventDefault();
            
            // Show confirmation dialog
            if (confirm('Apakah Anda yakin ingin logout?')) {
                // Show loading state
                const logoutLink = event.target;
                const originalText = logoutLink.innerHTML;
                logoutLink.innerHTML = '<i class="bi bi-arrow-repeat spin me-2"></i>Logging out...';
                logoutLink.style.pointerEvents = 'none';
                
                // Simulate logout process (replace with actual logout logic)
                setTimeout(() => {
                    alert('Logout berhasil! Anda akan diarahkan ke halaman login.');
                    window.location.href = '#login';
                }, 1500);
            }
        }

        // Add spinning animation for loading states
        const style = document.createElement('style');
        style.textContent = `
            .spin {
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);

        // Add navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.backgroundColor = '#ffffff';
                navbar.style.backdropFilter = 'none';
            }
        });


        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('#navbarNav');
                
                if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
