@extends('layouts.app')

@section('title', $categoryName . ' - MSA Mitrajaya Selaras Abadi')
@section('description', 'Katalog ' . strtolower($categoryName) . ' berkualitas tinggi dari MSA. Temukan produk terbaik untuk kebutuhan institusi kesehatan Anda.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-white">Produk & Layanan</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $categoryName }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">{{ $categoryName }}</h1>
                <p class="lead">Produk {{ strtolower($categoryName) }} berkualitas tinggi untuk institusi kesehatan</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-5">
    <div class="container">
        @if(count($products) > 0)
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow product-card">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        @if($category == 'alat-kesehatan-laboratorium')
                            <i class="fas fa-microscope" style="font-size: 5rem; color: var(--primary-color);"></i>
                        @elseif($category == 'produk-konsumabel')
                            <i class="fas fa-vial" style="font-size: 5rem; color: var(--primary-color);"></i>
                        @elseif($category == 'linen-apparel-rs')
                            <i class="fas fa-tshirt" style="font-size: 5rem; color: var(--primary-color);"></i>
                        @elseif($category == 'jasa-konsultan-maintenance')
                            <i class="fas fa-tools" style="font-size: 5rem; color: var(--primary-color);"></i>
                        @else
                            <i class="fas fa-user-tie" style="font-size: 5rem; color: var(--primary-color);"></i>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $product['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $product['brand'] }} {{ $product['model'] }}</p>
                        <p class="text-primary fw-bold mb-3">{{ $product['price_range'] }}</p>
                        
                        <div class="mb-3">
                            <h6 class="fw-bold">Spesifikasi:</h6>
                            <ul class="list-unstyled small">
                                @foreach(array_slice($product['specs'], 0, 3) as $spec)
                                <li><i class="fas fa-check text-success me-2"></i>{{ $spec }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="mt-auto">
                            <div class="d-grid gap-2">
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                                <a href="{{ route('rfq.create', $product['id']) }}" class="btn btn-primary">
                                    <i class="fas fa-file-alt me-2"></i>Minta Penawaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-lg-12 text-center py-5">
                <i class="fas fa-box-open" style="font-size: 5rem; color: var(--primary-color); opacity: 0.5;"></i>
                <h3 class="mt-3">Produk Segera Hadir</h3>
                <p class="text-muted">Kategori {{ strtolower($categoryName) }} sedang dalam proses update. Hubungi kami untuk informasi lebih lanjut.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Butuh Konsultasi untuk {{ $categoryName }}?</h3>
                <p class="mb-0">Tim ahli kami siap membantu Anda memilih produk {{ strtolower($categoryName) }} yang tepat sesuai kebutuhan institusi Anda.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20butuh%20konsultasi%20untuk%20{{ strtolower($categoryName) }}" class="btn btn-success btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>Konsultasi WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.7);
}
</style>
@endsection
