@extends('layouts.app')

@section('title', 'Kontak - MSA Mitrajaya Selaras Abadi')
@section('description', 'Hubungi MSA untuk konsultasi, penawaran, dan informasi produk alat kesehatan. Tim ahli kami siap membantu kebutuhan institusi kesehatan Anda.')

@section('content')
<!-- Hero Section with Animation -->
<section class="hero-contact py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white; position: relative; overflow: hidden;">
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3 animate-fade-in">Hubungi Kami</h1>
                <p class="lead mb-4 animate-fade-in-delay">Tim ahli MSA siap membantu kebutuhan alat kesehatan institusi Anda dengan solusi terbaik dan pelayanan profesional</p>
                <div class="d-flex gap-3 animate-fade-in-delay-2">
                    <div class="stat-item text-center">
                        <h3 class="fw-bold mb-1">24/7</h3>
                        <small>Support</small>
                    </div>
                    <div class="stat-item text-center">
                        <h3 class="fw-bold mb-1">100+</h3>
                        <small>Klien</small>
                    </div>
                    <div class="stat-item text-center">
                        <h3 class="fw-bold mb-1">17</h3>
                        <small>Tahun</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="contact-hero-image animate-float">
                    <img src="{{ asset('images/fotomeeting.jpg') }}" alt="MSA Team Meeting" class="img-fluid rounded-4 shadow-lg" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Cards -->
<section class="py-5" style="background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">Informasi Kontak</h2>
                <p class="text-muted">Berbagai cara untuk menghubungi tim MSA</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="contact-card h-100">
                    <div class="contact-icon-wrapper mb-4">
                        <div class="contact-icon bg-primary">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Alamat Kantor</h5>
                    <p class="text-muted mb-0">{{ $contact_info['address'] }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card h-100">
                    <div class="contact-icon-wrapper mb-4">
                        <div class="contact-icon bg-success">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">WhatsApp</h5>
                    <p class="text-muted mb-3">
                        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $contact_info['whatsapp']) }}" class="text-decoration-none text-success fw-semibold" target="_blank">
                            {{ $contact_info['whatsapp'] }}
                        </a>
                    </p>
                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $contact_info['whatsapp']) }}" class="btn btn-success btn-sm" target="_blank">
                        <i class="fab fa-whatsapp me-1"></i>Chat Now
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card h-100">
                    <div class="contact-icon-wrapper mb-4">
                        <div class="contact-icon bg-info">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Email</h5>
                    <div class="mb-3">
                        <small class="text-muted d-block">General:</small>
                        <a href="mailto:{{ $contact_info['email'] }}" class="text-decoration-none">
                            {{ $contact_info['email'] }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Customer Service:</small>
                        <a href="mailto:{{ $contact_info['email_cs'] }}" class="text-decoration-none">
                            {{ $contact_info['email_cs'] }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card h-100 bg-primary text-white">
                    <div class="contact-icon-wrapper mb-4">
                        <div class="contact-icon bg-white text-primary">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Jam Operasional</h5>
                    <p class="mb-2"><i class="fas fa-clock me-2"></i>{{ $contact_info['office_hours'] }}</p>
                    <p class="mb-2"><i class="fas fa-phone me-2"></i>Support 24/7 Emergency</p>
                    <p class="mb-0"><i class="fas fa-globe me-2"></i>{{ $contact_info['website'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row g-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="col-lg-5 bg-primary text-white p-5 d-flex flex-column justify-content-center">
                        <h3 class="fw-bold mb-4">Mari Berkolaborasi</h3>
                        <p class="mb-4">Kami siap membantu kebutuhan alat kesehatan institusi Anda dengan solusi terbaik dan pelayanan profesional.</p>
                        <div class="contact-benefits">
                            <div class="benefit-item mb-3">
                                <i class="fas fa-check-circle me-3"></i>
                                <span>Konsultasi gratis dengan ahli</span>
                            </div>
                            <div class="benefit-item mb-3">
                                <i class="fas fa-check-circle me-3"></i>
                                <span>Penawaran harga terbaik</span>
                            </div>
                            <div class="benefit-item mb-3">
                                <i class="fas fa-check-circle me-3"></i>
                                <span>Respon cepat dalam 1x24 jam</span>
                            </div>
                            <div class="benefit-item mb-3">
                                <i class="fas fa-check-circle me-3"></i>
                                <span>Garansi dan purna jual terpercaya</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 bg-white p-5">
                        <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company" class="form-label">Nama Perusahaan/Institusi</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}">
                                    @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h3 class="fw-bold">Lokasi Kantor</h3>
                <p class="text-muted">Kunjungi kantor kami untuk konsultasi langsung</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="map-container" style="height: 400px; border-radius: 10px; overflow: hidden;">
                    <iframe 
                        src="{{ $contact_info['maps_embed'] }}" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Contact Options -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h3 class="fw-bold">Kontak Cepat</h3>
                <p class="text-muted">Pilih cara tercepat untuk menghubungi kami</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="https://wa.me/628119466470?text=Halo,%20saya%20ingin%20konsultasi%20produk%20MSA" class="btn btn-success btn-lg w-100" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="mailto:{{ $contact_info['email'] }}" class="btn btn-secondary btn-lg w-100">
                    <i class="fas fa-envelope me-2"></i>Email
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h3 class="fw-bold">Frequently Asked Questions</h3>
                <p class="text-muted">Pertanyaan yang sering diajukan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                Berapa lama waktu pengiriman produk?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Waktu pengiriman bervariasi tergantung lokasi dan jenis produk. Untuk wilayah Jabodetabek biasanya 1-3 hari kerja, sedangkan untuk luar kota 3-7 hari kerja. Produk khusus atau import membutuhkan waktu 2-4 minggu.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                Apakah ada garansi untuk produk yang dibeli?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, semua produk yang kami jual dilengkapi dengan garansi resmi dari manufacturer. Periode garansi bervariasi mulai dari 1-3 tahun tergantung jenis produk. Kami juga menyediakan layanan purna jual dan maintenance.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                Bagaimana cara mendapatkan penawaran harga?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Anda dapat menghubungi kami via WhatsApp atau mengirim email dengan spesifikasi produk yang dibutuhkan. Tim kami akan memberikan penawaran terbaik dalam 1x24 jam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                Apakah menyediakan layanan instalasi dan training?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, kami menyediakan layanan instalasi oleh teknisi bersertifikat dan training penggunaan alat untuk tenaga medis. Layanan ini dapat disesuaikan dengan kebutuhan dan jadwal institusi Anda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
/* Hero Section Animations */
.hero-contact {
    min-height: 60vh;
}

.hero-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.shape {
    position: absolute;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    animation: float-shapes 6s ease-in-out infinite;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 70%;
    animation-delay: 4s;
}

@keyframes float-shapes {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.animate-fade-in {
    animation: fadeInUp 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeInUp 1s ease-out 0.3s both;
}

.animate-fade-in-delay-2 {
    animation: fadeInUp 1s ease-out 0.6s both;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.stat-item {
    background: rgba(255,255,255,0.1);
    padding: 1rem;
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

/* Contact Cards */
.contact-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}

.contact-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.contact-card:hover::before {
    left: 100%;
}

.contact-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.contact-icon-wrapper {
    position: relative;
}

.contact-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    position: relative;
    z-index: 2;
}

.contact-icon::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(255,255,255,0.3), transparent);
    z-index: -1;
}

/* Form Enhancements */
.benefit-item {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.benefit-item i {
    color: rgba(255,255,255,0.8);
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    transform: translateY(-2px);
}

.btn-primary {
    border-radius: 10px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
}

/* Map Container */
.map-container {
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.map-container:hover {
    transform: translateY(-5px);
}

/* Quick Contact Buttons */
.btn-lg {
    border-radius: 15px;
    padding: 1rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Accordion Styling */
.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.accordion-button {
    background: white;
    border: none;
    font-weight: 600;
    padding: 1.5rem;
}

.accordion-button:not(.collapsed) {
    background: var(--primary-color);
    color: white;
}

.accordion-body {
    padding: 1.5rem;
    background: #f8f9fa;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-contact {
        min-height: 50vh;
        text-align: center;
    }
    
    .contact-card {
        margin-bottom: 2rem;
    }
    
    .shape {
        display: none;
    }
}
</style>
@endsection
