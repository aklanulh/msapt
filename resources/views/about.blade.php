@extends('layouts.app')

@section('title', 'Tentang Kami - MSA | Mitrajaya Selaras Abadi')
@section('description', 'Mengenal lebih dekat PT Mitrajaya Selaras Abadi (MSA) - distributor alat kesehatan terpercaya dengan pengalaman puluhan tahun melayani institusi kesehatan di Indonesia.')

@section('styles')
<style>
    /* Counter Animation */
    .counter {
        font-weight: bold;
        color: var(--primary-color);
    }
    
    /* Floating Animation */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    
    /* Pulse Ring Animation */
    .pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 200px;
        height: 200px;
        border: 3px solid var(--primary-color);
        border-radius: 50%;
        opacity: 0.3;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0.7;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.2);
            opacity: 0.3;
        }
        100% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0.7;
        }
    }
    
    .experience-animation {
        position: relative;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .floating-icon {
        position: relative;
        z-index: 2;
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat PT Mitrajaya Selaras Abadi</p>
            </div>
        </div>
    </div>
</section>

<!-- Company Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">PT Mitrajaya Selaras Abadi</h2>
                <p class="lead mb-4">Distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit dengan komitmen tinggi terhadap kualitas dan pelayanan.</p>
                
                <div class="mb-4">
                    <p>PT. Mitrajaya Selaras Abadi (MSA) adalah perusahaan distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit yang berdiri dengan komitmen tinggi terhadap kualitas dan pelayanan. Kami menyediakan produk-produk kesehatan impor berkualitas tinggi yang telah memenuhi standar internasional dan digunakan oleh berbagai rumah sakit ternama di Indonesia.</p>
                    
                    <p>MSA hadir sebagai solusi kebutuhan alat kesehatan untuk rumah sakit, klinik, hingga individu, dengan harga kompetitif dan layanan purna jual berupa <strong>garansi 1 tahun untuk sparepart dan servis</strong>. Didukung oleh tenaga profesional dan sistem yang terkoordinasi, kami terus berupaya berkontribusi dalam mendukung pembangunan sektor kesehatan di era globalisasi.</p>
                    
                    <p>Kami terbuka untuk menjalin kerja sama strategis yang saling menguntungkan, dengan harapan setiap hasil kerja kami mampu memberikan kepuasan maksimal bagi seluruh mitra dan pelanggan.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Garansi 1 Tahun</h6>
                                <small class="text-muted">Sparepart & Servis</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-certificate text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Standar Internasional</h6>
                                <small class="text-muted">Produk Berkualitas Tinggi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <video autoplay loop muted class="img-fluid rounded shadow-lg" style="max-height: 400px; width: 100%; object-fit: cover;">
                        <source src="{{ asset('mapsmsa.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p class="text-muted mt-3"><small>Kantor Pusat MSA - Ruko Maison Avenue MA.19, Kota Wisata, Cibubur</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <video autoplay loop muted class="img-fluid rounded shadow" style="max-height: 300px; width: 100%; object-fit: cover;">
                                <source src="{{ asset('videotentangkami.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="fw-bold mb-3">Strategis</h3>
                        <p>Kantor pusat MSA berlokasi strategis di Kota Wisata, Cibubur. Lokasi yang mudah diakses memungkinkan kami melayani klien di seluruh Jabodetabek dan Indonesia dengan efisien.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Lokasi strategis di Cibubur</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Akses mudah dari berbagai wilayah</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Ruang meeting dan konsultasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-eye" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi Kami</h3>
                        <p class="text-center">{{ $companyInfo['vision'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-bullseye" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi Kami</h3>
                        <ul class="list-unstyled">
                            @foreach($companyInfo['mission'] as $mission)
                            <li class="mb-2">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i>
                                {{ $mission }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="experience-content">
                    <h2 class="display-4 fw-bold mb-4">
                        <span class="counter" data-target="17">0</span> 
                        <span style="color: var(--primary-color);">Tahun</span>
                    </h2>
                    <h3 class="fw-bold mb-3">Pengalaman Melayani Industri Kesehatan</h3>
                    <p class="lead mb-4">Sejak tahun 2008, MSA telah dipercaya sebagai mitra strategis dalam penyediaan alat medis, laboratorium, BMHP berkualitas dan konsultan.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">80+</h6>
                                    <small class="text-muted">Institusi Terpercaya</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">17</h6>
                                    <small class="text-muted">Tahun Pengalaman</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">500+</h6>
                                    <small class="text-muted">Jenis Produk Tersedia</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">24/7</h6>
                                    <small class="text-muted">Support Teknis</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="experience-animation">
                    <div class="floating-icon" style="animation: float 3s ease-in-out infinite;">
                        <i class="fas fa-award" style="font-size: 8rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                    <div class="pulse-ring"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Legal Information - Hidden -->
<!-- 
<section class="py-5" style="background-color: #f8f9fa; display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Legalitas Perusahaan</h2>
                <p class="lead text-muted">Informasi legal dan sertifikasi perusahaan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <strong>Nama Perusahaan:</strong><br>
                                {{ $companyInfo['legal']['company_name'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Registrasi:</strong><br>
                                {{ $companyInfo['legal']['registration'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Dokumen Legal:</strong><br>
                                {{ $companyInfo['legal']['documents'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Alamat:</strong><br>
                                {{ $companyInfo['legal']['address'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>WhatsApp:</strong><br>
                                {{ $companyInfo['legal']['whatsapp'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Website:</strong><br>
                                {{ $companyInfo['legal']['website'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Email:</strong><br>
                                @foreach($companyInfo['legal']['emails'] as $email)
                                    {{ $email }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
-->

<!-- Team Values -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Nilai-Nilai Perusahaan</h2>
                <p class="lead text-muted">Prinsip yang menjadi fondasi dalam setiap layanan kami</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Integritas</h5>
                    <p class="text-muted">Berkomitmen pada kejujuran dan transparansi dalam setiap transaksi bisnis.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-star" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kualitas</h5>
                    <p class="text-muted">Mengutamakan kualitas produk dan layanan terbaik untuk kepuasan klien.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-lightbulb" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Inovasi</h5>
                    <p class="text-muted">Terus berinovasi untuk memberikan solusi terdepan dalam industri kesehatan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-handshake" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kemitraan</h5>
                    <p class="text-muted">Membangun hubungan kemitraan yang saling menguntungkan dan berkelanjutan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Profesionalisme</h5>
                    <p class="text-muted">Tim profesional dengan keahlian tinggi dalam bidang alat kesehatan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-heart" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kepedulian</h5>
                    <p class="text-muted">Peduli terhadap peningkatan kualitas layanan kesehatan di Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Ingin Mengetahui Lebih Lanjut?</h3>
                <p class="mb-0">Hubungi tim kami untuk konsultasi dan informasi lebih detail tentang produk dan layanan MSA.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
                <a href="https://wa.me/628119466470?text=Halo,%20saya%20ingin%20mengetahui%20lebih%20lanjut%20tentang%20MSA" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Counter Animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        };
        
        // Intersection Observer for counter animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.counter');
                    if (counter && !counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounter(counter);
                    }
                }
            });
        });
        
        // Observe experience section
        const experienceSection = document.querySelector('.experience-content');
        if (experienceSection) {
            observer.observe(experienceSection);
        }
    });
</script>
@endsection
