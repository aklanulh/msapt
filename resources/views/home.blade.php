@extends('layouts.app')

@section('title', 'MSA - Mitrajaya Selaras Abadi | Penyedia Alat Kesehatan Terpercaya')
@section('description', 'PT Mitrajaya Selaras Abadi - Penyedia alat kesehatan, laboratorium, medis, dan jasa konsultan terpercaya untuk rumah sakit, laboratorium, dan institusi kesehatan di Indonesia.')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Solusi terpercaya untuk pengadaan <span style="color: var(--secondary-color);">alat medis, laboratorium, BMHP berkualitas dan konsultan</span>
                </h1>
                <p class="lead mb-4">
                    PT Mitrajaya Selaras Abadi menyediakan alat medis, peralatan laboratorium, serta BMHP berkualitas dengan harga kompetitif, didukung layanan konsultasi profesional bagi institusi kesehatan di seluruh Indonesia.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('products') }}" class="btn btn-light btn-lg" role="button" style="text-decoration: none; pointer-events: auto;">
                        <i class="fas fa-eye me-2"></i>Lihat Produk
                    </a>
                    <a href="https://wa.me/628119466470?text=Halo,%20saya%20tertarik%20dengan%20produk%20MSA" class="btn btn-outline-light btn-lg" target="_blank" role="button" style="text-decoration: none; pointer-events: auto;">
                        <i class="fab fa-whatsapp me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-video mt-5 mt-lg-0">
                    <video autoplay muted loop class="img-fluid" style="max-height: 500px; width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <source src="{{ asset('homemsa.mp4') }}" type="video/mp4">
                        <!-- Fallback image if video doesn't load -->
                        <img src="{{ asset('images/logo/msa-logo-bg.jpeg') }}" alt="MSA Logo" class="img-fluid logo-animation" style="max-height: 300px;">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5" style="background-color: var(--secondary-color);">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-building" style="font-size: 3rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                    <h2 class="display-4 fw-bold counter" data-target="80" style="color: var(--primary-color);">0</h2>
                    <p class="mb-0">Institusi Terpercaya</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                    <h2 class="display-4 fw-bold counter" data-target="17" style="color: var(--primary-color);">0</h2>
                    <p class="mb-0">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-boxes" style="font-size: 3rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                    <h2 class="display-4 fw-bold counter" data-target="500" style="color: var(--primary-color);">0</h2>
                    <p class="mb-0">Jenis Produk Tersedia</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-headset" style="font-size: 3rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">24/7</h2>
                    <p class="mb-0">Support Teknis</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Kategori Layanan Kami</h2>
                <p class="lead text-muted">Kami menyediakan berbagai kategori produk dan layanan untuk kebutuhan institusi kesehatan Anda</p>
            </div>
        </div>
        
        <!-- Product Carousel -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="product-carousel-container">
                    <div class="product-carousel">
                        @for($i = 1; $i <= 12; $i++)
                        <div class="product-slide">
                            <img src="{{ asset('images/produkMSA/' . $i . '.png') }}" alt="Produk MSA {{ $i }}" class="img-fluid">
                        </div>
                        @endfor
                        <!-- Duplicate slides for seamless loop -->
                        @for($i = 1; $i <= 12; $i++)
                        <div class="product-slide">
                            <img src="{{ asset('images/produkMSA/' . $i . '.png') }}" alt="Produk MSA {{ $i }}" class="img-fluid">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="service-icon mb-3">
                            <i class="{{ $service['icon'] }}" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title">{{ $service['title'] }}</h5>
                        <p class="card-text text-muted">{{ $service['description'] }}</p>
                        <a href="{{ $service['link'] }}" class="btn btn-outline-primary">
                            Lihat Produk <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Mengapa Memilih MSA?</h2>
                <p class="lead text-muted">Komitmen kami untuk memberikan yang terbaik bagi klien</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-award"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Kualitas Terjamin</h5>
                        <p class="text-muted mb-0">Produk berkualitas internasional dengan sertifikasi resmi dan garansi terpercaya.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Tim Profesional</h5>
                        <p class="text-muted mb-0">Didukung oleh tim ahli berpengalaman dalam bidang alat kesehatan dan medis.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-headset"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Support 24/7</h5>
                        <p class="text-muted mb-0">Layanan purna jual dan support teknis tersedia 24 jam untuk kepuasan klien.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Pengiriman Cepat</h5>
                        <p class="text-muted mb-0">Jaringan distribusi luas untuk pengiriman cepat ke seluruh Indonesia.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Kemitraan Jangka Panjang</h5>
                        <p class="text-muted mb-0">Membangun hubungan kemitraan yang saling menguntungkan dalam jangka panjang.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-certificate"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Legalitas Perusahaan</h5>
                        <p class="text-muted mb-0">Memiliki sertifikasi ISO 9001:2015 dan legalitas perusahaan yang lengkap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Business Partners Section -->
<section class="py-3" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-3">
                <h2 class="display-5 fw-bold mb-2">Mitra Bisnis Kami</h2>
                <p class="lead text-muted">Mitra terpercaya dalam menyediakan solusi alat kesehatan berkualitas tinggi</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <img src="{{ asset('images/business partner.png') }}" alt="Business Partners MSA" class="img-fluid business-partners-image">
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Testimoni Klien</h2>
                <p class="lead text-muted">Kepercayaan klien adalah prioritas utama kami</p>
            </div>
        </div>
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                            @endfor
                        </div>
                        <p class="card-text">"{{ $testimonial['content'] }}"</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $testimonial['name'] }}</h6>
                                <small class="text-muted">{{ $testimonial['position'] }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Siap Berpartner dengan MSA?</h3>
                <p class="mb-0">Dapatkan penawaran terbaik untuk kebutuhan alat kesehatan institusi Anda. Tim ahli kami siap membantu Anda menemukan solusi yang tepat.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('rfq.create') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-file-alt me-2"></i>Minta Penawaran
                </a>
                <a href="https://wa.me/628119466470?text=Halo,%20saya%20tertarik%20untuk%20berpartner%20dengan%20MSA" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%);
    color: white;
    padding: 100px 0 80px;
}

.logo-animation {
    animation: float 3s ease-in-out infinite;
}


@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Product Carousel Styles */
.product-carousel-container {
    overflow: hidden;
    width: 100%;
    position: relative;
}

.product-carousel {
    display: flex;
    animation: scroll 30s linear infinite;
    width: calc(200px * 24); /* 12 images * 2 (duplicated) * width */
}

.product-slide {
    flex: 0 0 200px;
    margin-right: 20px;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.product-slide:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.product-slide img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(calc(-200px * 12 - 20px * 12)); /* Move by width of 12 images */
    }
}

/* Pause animation on hover */
.product-carousel-container:hover .product-carousel {
    animation-play-state: paused;
}

/* Business Partners Styles */
.business-partners-container {
    background: white;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.business-partners-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.business-partners-image {
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.business-partners-image:hover {
    transform: scale(1.02);
}
</style>

<script>
// Counter Animation for Stats Section
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target + (target === 80 || target === 500 ? '+' : '');
            }
        };
        
        updateCounter();
    };
    
    // Intersection Observer for triggering animation when visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounter(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => {
        observer.observe(counter);
    });
});
</script>
