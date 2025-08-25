@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Panel MSA')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle p-3" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="fas fa-box fa-2x text-success"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-success">{{ $stats['total_products'] }}</h3>
                <p class="text-muted mb-0">Total Produk</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle p-3" style="background: rgba(0, 84, 164, 0.1);">
                        <i class="fas fa-microscope fa-2x" style="color: var(--primary-color);"></i>
                    </div>
                </div>
                <h3 class="fw-bold" style="color: var(--primary-color);">{{ $stats['alat_kesehatan'] }}</h3>
                <p class="text-muted mb-0">Alat Kesehatan</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle p-3" style="background: rgba(255, 193, 7, 0.1);">
                        <i class="fas fa-vial fa-2x text-warning"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-warning">{{ $stats['konsumabel'] }}</h3>
                <p class="text-muted mb-0">Konsumabel</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle p-3" style="background: rgba(220, 53, 69, 0.1);">
                        <i class="fas fa-tshirt fa-2x text-danger"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-danger">{{ $stats['linen_apparel'] }}</h3>
                <p class="text-muted mb-0">Linen & Apparel</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.products') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-list me-2"></i>Lihat Semua Produk
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.products.category', 'alat-kesehatan-laboratorium') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-microscope me-2"></i>Alat Kesehatan
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.products.category', 'produk-konsumabel') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-vial me-2"></i>Produk Konsumabel
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.products.category', 'linen-apparel-rs') }}" class="btn btn-outline-danger w-100 py-3">
                            <i class="fas fa-tshirt me-2"></i>Linen & Apparel RS
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.products.category', 'jasa-konsultan-maintenance') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-tools me-2"></i>Jasa Konsultan
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- System Info -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>System Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Laravel Version</small>
                    <div class="fw-bold">{{ app()->version() }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">PHP Version</small>
                    <div class="fw-bold">{{ PHP_VERSION }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Environment</small>
                    <div class="fw-bold">{{ config('app.env') }}</div>
                </div>
                <div class="mb-0">
                    <small class="text-muted">Last Login</small>
                    <div class="fw-bold">{{ now()->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Overview -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Kategori Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <div class="me-3">
                                <i class="fas fa-microscope fa-2x" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Alat Kesehatan & Laboratorium</h6>
                                <p class="text-muted mb-0">{{ $stats['alat_kesehatan'] }} produk</p>
                            </div>
                            <a href="{{ route('admin.products.category', 'alat-kesehatan-laboratorium') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <div class="me-3">
                                <i class="fas fa-vial fa-2x text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Produk Konsumabel</h6>
                                <p class="text-muted mb-0">{{ $stats['konsumabel'] }} produk</p>
                            </div>
                            <a href="{{ route('admin.products.category', 'produk-konsumabel') }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <div class="me-3">
                                <i class="fas fa-tshirt fa-2x text-danger"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Linen & Apparel RS</h6>
                                <p class="text-muted mb-0">{{ $stats['linen_apparel'] }} produk</p>
                            </div>
                            <a href="{{ route('admin.products.category', 'linen-apparel-rs') }}" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <div class="me-3">
                                <i class="fas fa-tools fa-2x text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Jasa Konsultan & Maintenance</h6>
                                <p class="text-muted mb-0">{{ $stats['jasa_konsultan'] }} layanan</p>
                            </div>
                            <a href="{{ route('admin.products.category', 'jasa-konsultan-maintenance') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
