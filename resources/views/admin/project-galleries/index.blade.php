@extends('admin.layouts.app')

@section('title', 'Kelola Galeri Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Kelola Galeri Proyek</h1>
                <a href="{{ route('admin.project-galleries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Galeri Proyek
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => ($sortBy == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            ID
                                            @if($sortBy == 'id')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'client', 'direction' => ($sortBy == 'client' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            Klien
                                            @if($sortBy == 'client')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'category', 'direction' => ($sortBy == 'category' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            Kategori
                                            @if($sortBy == 'category')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'year', 'direction' => ($sortBy == 'year' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            Tahun
                                            @if($sortBy == 'year')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galleries as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>{{ $gallery->client }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $gallery->category }}</span>
                                    </td>
                                    <td>{{ $gallery->year }}</td>
                                    <td>{{ Str::limit($gallery->description, 50) }}</td>
                                    <td>
                                        @php
                                            $images = is_array($gallery->images) ? $gallery->images : (json_decode($gallery->images, true) ?? []);
                                        @endphp
                                        @if(count($images) > 0)
                                            <span class="badge bg-info">{{ count($images) }} gambar</span>
                                        @else
                                            <span class="badge bg-warning">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($gallery->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.project-galleries.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.project-galleries.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus galeri proyek ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada galeri proyek</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.table th a {
    color: #495057 !important;
    font-weight: 600;
}

.table th a:hover {
    color: #007bff !important;
}

.table th a i {
    font-size: 0.8rem;
    opacity: 0.7;
}

.table th a:hover i {
    opacity: 1;
}
</style>
@endsection
