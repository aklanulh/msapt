@extends('admin.layouts.app')

@section('title', 'Tambah Produk - Admin Panel MSA')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Kelola Produk</a></li>
                <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Form Tambah Produk</h5>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
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
                                <option value="{{ $slug }}" {{ old('category') == $slug ? 'selected' : '' }}>{{ $name }}</option>
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
                                   id="brand" name="brand" value="{{ old('brand') }}">
                            @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                   id="model" name="model" value="{{ old('model') }}">
                            @error('model')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price_range" class="form-label">Harga</label>
                        <input type="text" class="form-control @error('price_range') is-invalid @enderror" 
                               id="price_range" name="price_range" value="{{ old('price_range') }}" 
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
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="features" class="form-label">Fitur Utama</label>
                        <textarea class="form-control @error('features') is-invalid @enderror" 
                                  id="features" name="features" rows="4" 
                                  placeholder="Masukkan setiap fitur di baris baru">{{ old('features') }}</textarea>
                        <small class="form-text text-muted">Masukkan setiap fitur di baris baru</small>
                        @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="specs" class="form-label">Spesifikasi Teknis</label>
                        <textarea class="form-control @error('specs') is-invalid @enderror" 
                                  id="specs" name="specs" rows="4" 
                                  placeholder="Format: nama_spec: nilai_spec (setiap spesifikasi di baris baru)">{{ old('specs') }}</textarea>
                        <small class="form-text text-muted">Format: nama_spec: nilai_spec (setiap spesifikasi di baris baru)</small>
                        @error('specs')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="applications" class="form-label">Aplikasi/Penggunaan</label>
                        <textarea class="form-control @error('applications') is-invalid @enderror" 
                                  id="applications" name="applications" rows="3" 
                                  placeholder="Masukkan setiap aplikasi di baris baru">{{ old('applications') }}</textarea>
                        <small class="form-text text-muted">Masukkan setiap aplikasi di baris baru</small>
                        @error('applications')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Produk Aktif
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
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
                
                <hr>
                
                <h6>Contoh Spesifikasi:</h6>
                <pre class="small bg-light p-2 rounded">throughput: 60 samples/hour
sample_volume: 20μL
technology: Flow Cytometry
display: 10.4" TFT LCD</pre>
            </div>
        </div>
    </div>
</div>
@endsection
