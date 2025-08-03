@extends('layouts.app')

@section('title', $product['name'] . ' - MSA Mitrajaya Selaras Abadi')
@section('description', 'Detail produk ' . $product['name'] . ' ' . $product['brand'] . ' ' . $product['model'] . ' dari MSA. Spesifikasi lengkap dan harga terbaik.')

@section('content')
<!-- Page Header -->
<section class="py-3" style="background-color: #f8f9fa;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk & Layanan</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.category', $product['category']) }}">{{ ucwords(str_replace('-', ' ', $product['category'])) }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Detail -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="product-image-container">
                    <div class="d-flex align-items-center justify-content-center" style="height: 400px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%); border-radius: 10px;">
                        @if($product['category'] == 'alat-kesehatan')
                            <i class="fas fa-heartbeat" style="font-size: 8rem; color: var(--primary-color);"></i>
                        @elseif($product['category'] == 'alat-laboratorium')
                            <i class="fas fa-microscope" style="font-size: 8rem; color: var(--primary-color);"></i>
                        @elseif($product['category'] == 'alat-medis')
                            <i class="fas fa-stethoscope" style="font-size: 8rem; color: var(--primary-color);"></i>
                        @else
                            <i class="fas fa-user-tie" style="font-size: 8rem; color: var(--primary-color);"></i>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">{{ $product['name'] }}</h1>
                <p class="text-muted mb-3">{{ $product['brand'] }} {{ $product['model'] }}</p>
                <h3 class="text-primary fw-bold mb-4">{{ $product['price_range'] }}</h3>
                
                <div class="mb-4">
                    <p>{{ $product['description'] }}</p>
                </div>

                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('rfq.create', $product['id']) }}" class="btn btn-primary btn-lg me-md-2">
                        <i class="fas fa-file-alt me-2"></i>Minta Penawaran
                    </a>
                    <a href="https://wa.me/6281194664700?text=Halo,%20saya%20tertarik%20dengan%20{{ $product['name'] }}" class="btn btn-success btn-lg" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Specifications -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4"><i class="fas fa-cogs me-2 text-primary"></i>Spesifikasi Teknis</h4>
                        <ul class="list-unstyled">
                            @foreach($product['specs'] as $spec)
                            <li class="mb-2">
                                <i class="fas fa-check-circle me-2 text-success"></i>{{ $spec }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4"><i class="fas fa-star me-2 text-primary"></i>Fitur Unggulan</h4>
                        <ul class="list-unstyled">
                            @foreach($product['features'] as $feature)
                            <li class="mb-2">
                                <i class="fas fa-arrow-right me-2 text-primary"></i>{{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if(count($relatedProducts) > 0)
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h3 class="fw-bold">Produk Terkait</h3>
                <p class="text-muted">Produk lain dalam kategori yang sama</p>
            </div>
        </div>
        <div class="row">
            @foreach(array_slice($relatedProducts, 0, 3) as $related)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        @if($related['category'] == 'alat-kesehatan')
                            <i class="fas fa-heartbeat" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($related['category'] == 'alat-laboratorium')
                            <i class="fas fa-microscope" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($related['category'] == 'alat-medis')
                            <i class="fas fa-stethoscope" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @else
                            <i class="fas fa-user-tie" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $related['name'] }}</h6>
                        <p class="card-text text-muted small">{{ $related['brand'] }} {{ $related['model'] }}</p>
                        <a href="{{ route('products.show', $related['id']) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Tertarik dengan {{ $product['name'] }}?</h3>
                <p class="mb-0">Dapatkan penawaran terbaik dan konsultasi gratis dari tim ahli kami.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('rfq.create', $product['id']) }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-file-alt me-2"></i>Minta Penawaran
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
