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
                                    <th>ID</th>
                                    <th>Klien</th>
                                    <th>Kategori</th>
                                    <th>Tahun</th>
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
