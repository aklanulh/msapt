@extends('admin.layouts.app')

@section('title', $categoryName . ' - Admin Panel MSA')
@section('page-title', $categoryName)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Kelola Produk</a></li>
                <li class="breadcrumb-item active">{{ $categoryName }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    @php
                    $icons = [
                        'alat-kesehatan-laboratorium' => 'fas fa-microscope',
                        'produk-konsumabel' => 'fas fa-vial',
                        'linen-apparel-rs' => 'fas fa-tshirt',
                        'jasa-konsultan-maintenance' => 'fas fa-tools'
                    ];
                    @endphp
                    <i class="{{ $icons[$category] ?? 'fas fa-box' }} me-2"></i>{{ $categoryName }}
                </h5>
                <div>
                    <span class="badge bg-primary">{{ count($products) }} Produk</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-secondary">ID: {{ $product['id'] }}</span>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.products.show', $product['id']) }}">
                                                <i class="fas fa-eye me-2"></i>Detail
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('products.show', $product['id']) }}" target="_blank">
                                                <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <h6 class="card-title">{{ $product['name'] }}</h6>
                                
                                @if(isset($product['brand']))
                                <p class="text-muted mb-2">
                                    <i class="fas fa-tag me-1"></i>{{ $product['brand'] }}
                                </p>
                                @endif
                                
                                @if(isset($product['model']))
                                <p class="text-muted mb-2">
                                    <i class="fas fa-cube me-1"></i>{{ $product['model'] }}
                                </p>
                                @endif
                                
                                @if(isset($product['description']))
                                <p class="card-text small text-muted">
                                    {{ Str::limit($product['description'], 100) }}
                                </p>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-success fw-bold">
                                        {{ $product['price_range'] ?? 'Hubungi untuk harga' }}
                                    </small>
                                    <a href="{{ route('admin.products.show', $product['id']) }}" class="btn btn-sm btn-primary">
                                        Detail <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if(count($products) == 0)
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada produk dalam kategori ini</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
