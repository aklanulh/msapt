@extends('admin.layouts.app')

@section('title', 'Kelola Produk - Admin Panel MSA')
@section('page-title', 'Kelola Produk')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-box me-2"></i>Semua Produk</h5>
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success me-2">
                        <i class="fas fa-plus me-1"></i>Tambah Produk
                    </a>
                    <span class="badge bg-primary">{{ count($allProducts) }} Total Produk</span>
                </div>
            </div>
            <div class="card-body">
                <!-- Category Filter -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-select" id="categoryFilter">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $slug => $name)
                            <option value="{{ $slug }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="searchProduct" placeholder="Cari produk...">
                    </div>
                </div>
                
                <!-- Products Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productsTable">
                            @if($allProducts && count($allProducts) > 0)
                            @foreach($allProducts as $product)
                            <tr data-category="{{ $product->category }}" data-name="{{ strtolower($product->name) }}">
                                <td><span class="badge bg-secondary">{{ $product->id }}</span></td>
                                <td>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    @if($product->model)
                                    <small class="text-muted">Model: {{ $product->model }}</small>
                                    @endif
                                </td>
                                <td>{{ $product->brand ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $product->category_name }}</span>
                                </td>
                                <td>{{ $product->price_range ?? 'Hubungi untuk harga' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('products.show', $product->id) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada produk yang tersedia</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Category Access -->
<div class="row">
    @foreach($categories as $slug => $name)
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body text-center">
                @php
                $icons = [
                    'alat-kesehatan-laboratorium' => 'fas fa-microscope text-primary',
                    'produk-konsumabel' => 'fas fa-vial text-warning',
                    'linen-apparel-rs' => 'fas fa-tshirt text-danger',
                    'jasa-konsultan-maintenance' => 'fas fa-tools text-info'
                ];
                $counts = [
                    'alat-kesehatan-laboratorium' => collect($allProducts)->where('category', 'alat-kesehatan-laboratorium')->count(),
                    'produk-konsumabel' => collect($allProducts)->where('category', 'produk-konsumabel')->count(),
                    'linen-apparel-rs' => collect($allProducts)->where('category', 'linen-apparel-rs')->count(),
                    'jasa-konsultan-maintenance' => collect($allProducts)->where('category', 'jasa-konsultan-maintenance')->count()
                ];
                @endphp
                <i class="{{ $icons[$slug] }} fa-2x mb-3"></i>
                <h6>{{ $name }}</h6>
                <p class="text-muted mb-2">{{ $counts[$slug] }} produk</p>
                <a href="{{ route('admin.products.category', $slug) }}" class="btn btn-sm btn-outline-primary">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const searchProduct = document.getElementById('searchProduct');
    const productsTable = document.getElementById('productsTable');
    const rows = productsTable.querySelectorAll('tr');

    function filterProducts() {
        const selectedCategory = categoryFilter.value;
        const searchTerm = searchProduct.value.toLowerCase();

        rows.forEach(row => {
            const category = row.dataset.category;
            const name = row.dataset.name;
            
            const categoryMatch = !selectedCategory || category === selectedCategory;
            const nameMatch = !searchTerm || name.includes(searchTerm);
            
            if (categoryMatch && nameMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    categoryFilter.addEventListener('change', filterProducts);
    searchProduct.addEventListener('input', filterProducts);
});
</script>
@endsection
