@extends('layouts.app')

@section('title', 'Produk & Layanan - MSA Mitrajaya Selaras Abadi')
@section('description', 'Katalog lengkap produk alat kesehatan, laboratorium, medis, dan jasa konsultan dari MSA. Temukan solusi terbaik untuk kebutuhan institusi kesehatan Anda.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Produk & Layanan</h1>
                <p class="lead">Solusi lengkap untuk kebutuhan alat kesehatan institusi Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-4" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-lg me-2" placeholder="Cari produk atau brand..." value="{{ request('q') }}">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Kategori Produk</h2>
                <p class="lead text-muted">Pilih kategori sesuai kebutuhan institusi kesehatan Anda</p>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow category-card">
                    <div class="row g-0 h-100">
                        <div class="col-md-4">
                            <div class="category-image d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                                @php
                                    $categoryIcons = [
                                        'alat-kesehatan-laboratorium' => 'fas fa-microscope',
                                        'produk-konsumabel' => 'fas fa-vial',
                                        'linen-apparel-rs' => 'fas fa-tshirt',
                                        'jasa-konsultan-maintenance' => 'fas fa-tools',
                                        // Legacy support for old category slugs
                                        'alat-kesehatan' => 'fas fa-heartbeat',
                                        'alat-laboratorium' => 'fas fa-microscope',
                                        'alat-medis' => 'fas fa-stethoscope'
                                    ];
                                    $iconClass = $categoryIcons[$category['slug']] ?? 'fas fa-boxes';
                                @endphp
                                <i class="{{ $iconClass }}" style="font-size: 4rem; color: var(--primary-color);"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column h-100">
                                <h5 class="card-title fw-bold">{{ $category['name'] }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ $category['description'] }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $category['product_count'] }} produk tersedia</small>
                                    <a href="{{ route('products.category', $category['slug']) }}" class="btn btn-primary">
                                        Lihat Produk <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Produk Unggulan</h2>
                <p class="lead text-muted">Produk-produk terpopuler dan terlaris dari MSA</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        <i class="fas fa-desktop" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Monitor Pasien Multiparameter</h5>
                        <p class="card-text text-muted">Monitor vital signs dengan teknologi terdepan untuk ICU dan ruang perawatan.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Philips IntelliVue</small>
                            <a href="{{ route('products.category', 'alat-kesehatan') }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        <i class="fas fa-vial" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hematology Analyzer</h5>
                        <p class="card-text text-muted">Analisis darah otomatis dengan akurasi tinggi untuk laboratorium modern.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Sysmex XN-1000</small>
                            <a href="{{ route('products.category', 'alat-laboratorium') }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        <i class="fas fa-lungs" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Ventilator ICU</h5>
                        <p class="card-text text-muted">Ventilator canggih untuk perawatan intensif dengan berbagai mode ventilasi.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Drager Evita V300</small>
                            <a href="{{ route('products.category', 'alat-kesehatan') }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Layanan Kami</h2>
                <p class="lead text-muted">Layanan komprehensif untuk mendukung operasional institusi kesehatan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shopping-cart" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Pengadaan</h5>
                    <p class="text-muted">Pengadaan alat kesehatan sesuai spesifikasi dan budget institusi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-tools" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Instalasi</h5>
                    <p class="text-muted">Instalasi dan commissioning peralatan oleh teknisi bersertifikat.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-graduation-cap" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Training</h5>
                    <p class="text-muted">Pelatihan penggunaan alat untuk tenaga medis dan teknisi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-wrench" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Maintenance</h5>
                    <p class="text-muted">Layanan maintenance berkala dan perbaikan alat kesehatan.</p>
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
                <h3 class="mb-3">Butuh Konsultasi Produk?</h3>
                <p class="mb-0">Tim ahli kami siap membantu Anda memilih produk yang tepat sesuai kebutuhan dan budget institusi Anda.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('rfq.create') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-file-alt me-2"></i>Minta Penawaran
                </a>
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20butuh%20konsultasi%20produk%20MSA" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>Konsultasi
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
