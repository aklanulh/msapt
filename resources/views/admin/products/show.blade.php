@extends('admin.layouts.app')

@section('title', $product['name'] . ' - Admin Panel MSA')
@section('page-title', 'Detail Produk')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Kelola Produk</a></li>
                <li class="breadcrumb-item active">{{ $product['name'] }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        @if($product->images && count($product->images) > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-images me-2"></i>Foto Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($product->images as $image)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded shadow" style="height: 200px; width: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Produk</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>ID Produk:</strong></div>
                    <div class="col-sm-9"><span class="badge bg-secondary">{{ $product['id'] }}</span></div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Nama Produk:</strong></div>
                    <div class="col-sm-9">{{ $product['name'] }}</div>
                </div>
                
                @if(isset($product['brand']))
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Brand:</strong></div>
                    <div class="col-sm-9">{{ $product['brand'] }}</div>
                </div>
                @endif
                
                @if(isset($product['model']))
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Model:</strong></div>
                    <div class="col-sm-9">{{ $product['model'] }}</div>
                </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Harga:</strong></div>
                    <div class="col-sm-9">
                        <span class="text-success fw-bold">{{ $product['price_range'] ?? 'Hubungi untuk harga' }}</span>
                    </div>
                </div>
                
                @if(isset($product['description']))
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Deskripsi:</strong></div>
                    <div class="col-sm-9">{{ $product['description'] }}</div>
                </div>
                @endif
            </div>
        </div>
        
        @if(isset($product['features']) && is_array($product['features']))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-star me-2"></i>Fitur Utama</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach($product['features'] as $feature)
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>{{ $feature }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        
        @if(isset($product['specs']) && is_array($product['specs']))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Spesifikasi Teknis</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        @foreach($product['specs'] as $key => $value)
                        <tr>
                            <td class="fw-bold" style="width: 30%;">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Aksi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product['id']) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Produk
                    </a>
                    <hr>
                    <a href="{{ route('products.show', $product['id']) }}" target="_blank" class="btn btn-success">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                    </a>
                    <a href="{{ route('rfq.create', $product['id']) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-file-alt me-2"></i>Form RFQ
                    </a>
                    <hr>
                    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Statistik</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                        <div class="fw-bold">Views</div>
                        <div class="text-muted">Data tidak tersedia</div>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-file-alt fa-2x text-info mb-2"></i>
                        <div class="fw-bold">RFQ Requests</div>
                        <div class="text-muted">Data tidak tersedia</div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($product['applications']) && is_array($product['applications']))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-hospital me-2"></i>Aplikasi</h5>
            </div>
            <div class="card-body">
                @foreach($product['applications'] as $application)
                <span class="badge bg-light text-dark me-1 mb-1">{{ $application }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
