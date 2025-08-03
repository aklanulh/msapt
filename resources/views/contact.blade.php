@extends('layouts.app')

@section('title', 'Kontak - MSA Mitrajaya Selaras Abadi')
@section('description', 'Hubungi MSA untuk konsultasi, penawaran, dan informasi produk alat kesehatan. Tim ahli kami siap membantu kebutuhan institusi kesehatan Anda.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
                <p class="lead">Tim ahli MSA siap membantu kebutuhan alat kesehatan institusi Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="contact-item text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-map-marker-alt" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold">Alamat Kantor</h5>
                            <p class="text-muted">{{ $contact_info['address'] }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="contact-item text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-phone" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold">Telepon</h5>
                            <p class="text-muted">{{ $contact_info['phone'] }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="contact-item text-center">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fab fa-whatsapp" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold">WhatsApp</h5>
                            <p class="text-muted">
                                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $contact_info['whatsapp']) }}" class="text-decoration-none" target="_blank">
                                    {{ $contact_info['whatsapp'] }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="contact-item text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-envelope" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold">Email</h5>
                            <p class="text-muted">
                                <a href="mailto:{{ $contact_info['email'] }}" class="text-decoration-none">
                                    {{ $contact_info['email'] }}
                                </a><br>
                                <a href="mailto:{{ $contact_info['email_cs'] }}" class="text-decoration-none">
                                    {{ $contact_info['email_cs'] }}
                                </a><br>
                                <a href="mailto:{{ $contact_info['email_alt'] }}" class="text-decoration-none">
                                    {{ $contact_info['email_alt'] }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Jam Operasional</h5>
                        <p class="mb-2"><i class="fas fa-clock me-2 text-primary"></i>{{ $contact_info['office_hours'] }}</p>
                        <p class="mb-2"><i class="fas fa-phone me-2 text-primary"></i>Support 24/7 untuk emergency</p>
                        <p class="mb-0"><i class="fas fa-globe me-2 text-primary"></i>{{ $contact_info['website'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-center mb-4">Kirim Pesan</h3>
                        <p class="text-center text-muted mb-4">Isi form di bawah ini dan tim kami akan menghubungi Anda dalam 1x24 jam</p>
                        
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
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20ingin%20konsultasi%20produk%20MSA" class="btn btn-success btn-lg w-100" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="tel:{{ $contact_info['phone'] }}" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-phone me-2"></i>Telepon
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="mailto:{{ $contact_info['email'] }}" class="btn btn-secondary btn-lg w-100">
                    <i class="fas fa-envelope me-2"></i>Email
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="{{ route('rfq.create') }}" class="btn btn-warning btn-lg w-100">
                    <i class="fas fa-file-alt me-2"></i>Request Quote
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
                                Anda dapat mengisi form Request for Quotation (RFQ) di website kami, menghubungi via WhatsApp, atau mengirim email dengan spesifikasi produk yang dibutuhkan. Tim kami akan memberikan penawaran terbaik dalam 1x24 jam.
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
.contact-item {
    transition: transform 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-5px);
}

.map-container {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
