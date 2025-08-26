@extends('admin.layouts.app')

@section('title', 'Edit Produk - Admin Panel MSA')
@section('page-title', 'Edit Produk')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Kelola Produk</a></li>
                <li class="breadcrumb-item active">Edit: {{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Produk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @if($categories && is_array($categories))
                                @foreach($categories as $slug => $name)
                                <option value="{{ $slug }}" {{ old('category', $product->category) == $slug ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                   id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                            @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                   id="model" name="model" value="{{ old('model', $product->model) }}">
                            @error('model')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price_range" class="form-label">Harga</label>
                        <input type="text" class="form-control @error('price_range') is-invalid @enderror" 
                               id="price_range" name="price_range" value="{{ old('price_range', $product->price_range) }}" 
                               placeholder="Contoh: Rp 1.000.000 - Rp 2.000.000 atau Hubungi untuk harga">
                        @error('price_range')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="images" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" 
                               id="images" name="images[]" multiple accept="image/*">
                        <small class="form-text text-muted">Pilih 0 atau lebih foto produk (format: JPG, PNG, GIF)</small>
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        @if($product->images && count($product->images) > 0)
                        <div class="mt-2">
                            <small class="text-muted">Foto saat ini:</small>
                            <div class="row mt-2">
                                @foreach($product->images as $image)
                                <div class="col-md-3 mb-2">
                                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="features" class="form-label">Fitur Utama</label>
                        <textarea class="form-control @error('features') is-invalid @enderror" 
                                  id="features" name="features" rows="4" 
                                  placeholder="Masukkan setiap fitur di baris baru">{{ old('features', is_array($product->features) ? implode("\n", $product->features) : '') }}</textarea>
                        <small class="form-text text-muted">Masukkan setiap fitur di baris baru</small>
                        @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="specs" class="form-label">Spesifikasi Teknis</label>
                        <textarea class="form-control @error('specs') is-invalid @enderror" 
                                  id="specs" name="specs" rows="4" 
                                  placeholder="Format: nama_spec: nilai_spec (setiap spesifikasi di baris baru)">{{ old('specs', is_array($product->specs) ? implode("\n", array_map(function($key, $value) { return $key . ': ' . $value; }, array_keys($product->specs), $product->specs)) : '') }}</textarea>
                        <small class="form-text text-muted">Format: nama_spec: nilai_spec (setiap spesifikasi di baris baru)</small>
                        @error('specs')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="applications" class="form-label">Aplikasi/Penggunaan</label>
                        <textarea class="form-control @error('applications') is-invalid @enderror" 
                                  id="applications" name="applications" rows="3" 
                                  placeholder="Masukkan setiap aplikasi di baris baru">{{ old('applications', is_array($product->applications) ? implode("\n", $product->applications) : '') }}</textarea>
                        <small class="form-text text-muted">Masukkan setiap aplikasi di baris baru</small>
                        @error('applications')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Tampilkan di Publik
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Info Produk</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>ID:</strong> {{ $product->id }}
                </div>
                <div class="mb-2">
                    <strong>Dibuat:</strong> {{ $product->created_at->format('d M Y, H:i') }}
                </div>
                <div class="mb-2">
                    <strong>Diperbarui:</strong> {{ $product->updated_at->format('d M Y, H:i') }}
                </div>
                <div class="mb-2">
                    <strong>Status:</strong> 
                    <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                
                <hr>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                    <a href="{{ route('products.show', $product->id) }}" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-external-link-alt me-1"></i>Lihat di Website
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Panduan</h6>
            </div>
            <div class="card-body">
                <h6>Tips Mengisi Form:</h6>
                <ul class="small">
                    <li><strong>Nama Produk:</strong> Gunakan nama lengkap dan jelas</li>
                    <li><strong>Brand:</strong> Nama merek/manufacturer</li>
                    <li><strong>Model:</strong> Tipe/seri produk</li>
                    <li><strong>Fitur:</strong> Satu fitur per baris</li>
                    <li><strong>Spesifikasi:</strong> Format "nama: nilai"</li>
                    <li><strong>Aplikasi:</strong> Satu penggunaan per baris</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
