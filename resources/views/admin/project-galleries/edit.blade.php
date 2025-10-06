@extends('admin.layouts.app')

@section('title', 'Edit Galeri Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Edit Galeri Proyek</h1>
                <a href="{{ route('admin.project-galleries') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.project-galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client" class="form-label">Nama Klien <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $gallery->client) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" {{ old('category', $gallery->category) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="year" name="year" min="2000" max="{{ date('Y') + 1 }}" value="{{ old('year', $gallery->year) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" {{ old('is_active', $gallery->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $gallery->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $gallery->description) }}</textarea>
                        </div>

                        @php
                            $images = is_array($gallery->images) ? $gallery->images : (json_decode($gallery->images, true) ?? []);
                        @endphp
                        @if(count($images) > 0)
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div class="row">
                                @foreach($images as $image)
                                <div class="col-md-3 mb-2">
                                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Project Image">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Gambar Baru (Opsional)</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            <div class="form-text">Pilih gambar baru jika ingin mengganti. Kosongkan jika tidak ingin mengubah gambar.</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
