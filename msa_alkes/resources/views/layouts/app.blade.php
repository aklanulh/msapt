<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MSA - Mitrajaya Selaras Abadi')</title>
    <meta name="description" content="@yield('description', 'PT Mitrajaya Selaras Abadi - Penyedia alat kesehatan, laboratorium, medis, dan jasa konsultan terpercaya')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_browser.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_browser.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0054a4;
            --secondary-color: #c4fffb;
            --accent-color: #8ef4f6;
            --white-color: #ffffff;
            --text-dark: #333333;
            --text-light: #666666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Header Styles */
        .navbar {
            background: var(--white-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand img {
            transition: all 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0,84,164,0.2));
        }

        .navbar-brand:hover img {
            filter: drop-shadow(0 4px 8px rgba(0,84,164,0.3));
            transform: translateY(-2px);
        }

        /* Logo Animation */
        @keyframes logoFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-animated {
            animation: logoFadeIn 0.8s ease-out;
        }

        /* Footer Logo Animation */
        .footer-logo {
            transition: all 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.02);
            background: rgba(255,255,255,0.2) !important;
            box-shadow: 0 4px 12px rgba(255,255,255,0.2);
        }

        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003d7a;
            border-color: #003d7a;
            transform: translateY(-2px);
        }

        /* Ensure all buttons are clickable */
        .btn {
            cursor: pointer !important;
            pointer-events: auto !important;
            text-decoration: none !important;
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .btn:hover {
            text-decoration: none !important;
        }

        /* Fix for hero section buttons */
        .hero-section .btn {
            position: relative;
            z-index: 10;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background-color: #128c7e;
            color: white;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer h5 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--secondary-color);
        }

        /* Breadcrumb Fixes */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
            overflow: visible;
            white-space: nowrap;
        }

        .breadcrumb-item {
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            color: #6c757d;
            margin: 0 0.5rem;
            display: inline-block;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: #003d7a;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        /* Ensure breadcrumb section has proper spacing */
        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 24px;
            }
            
            .breadcrumb {
                font-size: 0.8rem;
                flex-wrap: wrap;
            }
            
            .breadcrumb-item {
                white-space: normal;
                word-break: break-word;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/msa-logo-original.png') }}" alt="MSA Logo" class="logo-animated" style="height: 70px; width: auto; max-width: 200px;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            Produk & Layanan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('products') }}">Semua Kategori</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('products.category', 'alat-kesehatan-laboratorium') }}">Alat Kesehatan & Laboratorium</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.category', 'produk-konsumabel') }}">Produk Konsumabel</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.category', 'linen-apparel-rs') }}">Linen & Apparel RS</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.category', 'jasa-konsultan-maintenance') }}">Jasa Konsultan & Maintenance</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catalog') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects') }}">Klien & Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo/msa-logo-original.png') }}" alt="MSA Logo" class="footer-logo" style="height: 80px; width: auto; max-width: 250px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 8px;">
                    </div>
                    <p>PT Mitrajaya Selaras Abadi adalah distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit dengan komitmen tinggi terhadap kualitas dan pelayanan. Kami menyediakan produk-produk kesehatan impor berkualitas tinggi dengan garansi 1 tahun untuk sparepart dan servis.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/mitrajaya.s.abadi.5" target="_blank" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/msa_pengadaanalkes" target="_blank" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/kadarusman-ebet-818a4b2a" target="_blank" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.youtube.com/watch?v=CaUhnijlinM&ab_channel=PengadaanCompany" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Produk</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products.category', 'alat-kesehatan-laboratorium') }}">Alat Kesehatan & Laboratorium</a></li>
                        <li><a href="{{ route('products.category', 'produk-konsumabel') }}">Produk Konsumabel</a></li>
                        <li><a href="{{ route('products.category', 'linen-apparel-rs') }}">Linen & Apparel RS</a></li>
                        <li><a href="{{ route('products.category', 'jasa-konsultan-maintenance') }}">Jasa Konsultan & Maintenance</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('projects') }}">Klien & Proyek</a></li>
                        <li><a href="{{ route('blog') }}">Artikel</a></li>
                        <li><a href="{{ route('catalog') }}">Katalog</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Ruko Maison Avenue MA.19, Kota Wisata, Cibubur, Kabupaten Bogor, 16820</li>
                        <li><i class="fas fa-phone me-2"></i>(021) 824-82412</li>
                        <li><i class="fas fa-envelope me-2"></i>marketing@ptmsa.biz.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>0811 9466 470</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} PT. Mitrajaya Selaras Abadi (MSA). All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281194664700?text=Halo,%20saya%20tertarik%20dengan%20produk%20MSA" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Ensure all buttons are clickable and functional
        document.addEventListener('DOMContentLoaded', function() {
            // Fix any button click issues
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.style.pointerEvents = 'auto';
                button.style.cursor = 'pointer';
                
                // Ensure links work properly
                if (button.tagName === 'A' && button.href) {
                    button.addEventListener('click', function(e) {
                        if (this.target === '_blank') {
                            window.open(this.href, '_blank');
                        } else {
                            window.location.href = this.href;
                        }
                    });
                }
            });
            
            // Smooth scrolling for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
            
            // WhatsApp float button functionality
            const whatsappFloat = document.querySelector('.whatsapp-float');
            if (whatsappFloat) {
                whatsappFloat.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.open(this.href, '_blank');
                });
            }
        });
        
        // Download catalog function
        function downloadCatalog(filename) {
            alert('Katalog ' + filename + ' akan segera didownload. Fitur ini akan segera diaktifkan.');
        }
    </script>
    
    @yield('scripts')
</body>
</html>
