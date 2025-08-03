@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . $query . ' - MSA Mitrajaya Selaras Abadi')
@section('description', 'Hasil pencarian produk "' . $query . '" di katalog MSA. Temukan alat kesehatan, laboratorium, dan medis yang Anda cari.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="display-5 fw-bold mb-3">Hasil Pencarian</h1>
                <p class="lead">Menampilkan hasil untuk: "<strong>{{ $query }}</strong>"</p>
            </div>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="py-5">
    <div class="container">
        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-lg me-2" placeholder="Cari produk atau brand..." value="{{ $query }}">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        @if(count($products) > 0)
        <div class="row mb-4">
            <div class="col-lg-12">
                <p class="text-muted">Ditemukan {{ count($products) }} produk</p>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow product-card">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        @if($product['category'] == 'alat-kesehatan')
                            <i class="fas fa-heartbeat" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($product['category'] == 'alat-laboratorium')
                            <i class="fas fa-microscope" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($product['category'] == 'alat-medis')
                            <i class="fas fa-stethoscope" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @else
                            <i class="fas fa-user-tie" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $product['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $product['brand'] }} {{ $product['model'] }}</p>
                        <p class="text-primary fw-bold mb-3">{{ $product['price_range'] }}</p>
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
                <i class="fas fa-search" style="font-size: 5rem; color: var(--primary-color); opacity: 0.5;"></i>
                <h3 class="mt-3">Tidak Ada Hasil Ditemukan</h3>
                <p class="text-muted mb-4">Maaf, tidak ada produk yang cocok dengan pencarian "{{ $query }}".</p>
                <div class="suggestions">
                    <h5>Saran:</h5>
                    <ul class="list-unstyled">
                        <li>• Periksa ejaan kata kunci</li>
                        <li>• Gunakan kata kunci yang lebih umum</li>
                        <li>• Coba kategori produk yang berbeda</li>
                    </ul>
                </div>
                <a href="{{ route('products') }}" class="btn btn-primary">
                    <i class="fas fa-th-large me-2"></i>Lihat Semua Kategori
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Popular Categories -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h3 class="fw-bold">Kategori Populer</h3>
                <p class="text-muted">Jelajahi kategori produk kami</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="{{ route('products.category', 'alat-kesehatan') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-heartbeat me-2"></i>Alat Kesehatan
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="{{ route('products.category', 'alat-laboratorium') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-microscope me-2"></i>Alat Laboratorium
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="{{ route('products.category', 'alat-medis') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-stethoscope me-2"></i>Alat Medis
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <a href="{{ route('products.category', 'jasa-konsultan') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-user-tie me-2"></i>Jasa Konsultan
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
</style>
@endsection
