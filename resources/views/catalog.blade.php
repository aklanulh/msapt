@extends('layouts.app')

@section('title', 'Katalog Produk - MSA Mitrajaya Selaras Abadi')
@section('description', 'Download katalog lengkap produk alat kesehatan, laboratorium, dan medis dari MSA. Dapatkan informasi detail dan spesifikasi produk terbaru.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Katalog Produk</h1>
                <p class="lead">Jelajahi katalog lengkap produk MSA untuk referensi dan pengadaan</p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Isi halaman ini hanya ilustrasi. Konten lengkap akan segera tersedia.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catalog Downloads -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Katalog Produk Kami</h2>
                <p class="lead text-muted">Jelajahi berbagai kategori produk dengan informasi lengkap dan spesifikasi</p>
            </div>
        </div>
        <div class="row">
            @foreach($catalogs as $catalog)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow catalog-card">
                    <div class="card-body text-center">
                        <div class="catalog-icon mb-4">
                            <i class="{{ $catalog['icon'] }}" style="font-size: 4rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold">{{ $catalog['title'] }}</h5>
                        <p class="card-text text-muted">{{ $catalog['description'] }}</p>
                        
                        <div class="d-grid">
                            <a href="https://wa.me/6281194664700?text=Halo,%20saya%20ingin%20mendapatkan%20informasi%20tentang%20{{ urlencode($catalog['title']) }}" class="btn btn-success btn-lg" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Tanya via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Catalog Features -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Apa yang Ada di Katalog Kami?</h2>
                <p class="lead text-muted">Informasi lengkap yang Anda butuhkan untuk pengadaan alat kesehatan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-list-alt" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Spesifikasi Detail</h5>
                    <p class="text-muted">Spesifikasi teknis lengkap setiap produk dengan gambar berkualitas tinggi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-tags" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Informasi Harga</h5>
                    <p class="text-muted">Range harga dan informasi paket bundling untuk efisiensi budget.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-laptop" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">E-Catalog</h5>
                    <p class="text-muted">Katalog digital interaktif yang mudah diakses kapan saja dan dimana saja.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-certificate" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Sertifikasi</h5>
                    <p class="text-muted">Informasi sertifikasi dan compliance setiap produk sesuai standar internasional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Catalog Request -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Butuh Informasi Lebih Lanjut?</h3>
                <p class="mb-0">Kami dapat memberikan informasi detail dan konsultasi sesuai kebutuhan spesifik institusi Anda, termasuk rekomendasi produk dan solusi yang disesuaikan dengan budget dan requirement.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20ingin%20mendapatkan%20informasi%20produk%20dari%20MSA" class="btn btn-success btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="fw-bold mb-3">Dapatkan Update Produk Terbaru</h3>
                <p class="mb-4">Berlangganan newsletter kami untuk mendapatkan notifikasi produk terbaru dan penawaran khusus.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <input type="email" class="form-control form-control-lg" placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-light btn-lg w-100">
                            <i class="fas fa-paper-plane me-2"></i>Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.catalog-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.catalog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection

@section('scripts')
<script>
// Catalog page interactions can be added here if needed
</script>
@endsection
