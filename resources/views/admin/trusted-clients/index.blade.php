@extends('admin.layouts.app')

@section('title', 'Kelola Klien Terpercaya')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Kelola Klien Terpercaya</h1>
                <a href="{{ route('admin.trusted-clients.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Klien Terpercaya
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
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'hospital_name', 'direction' => ($sortBy == 'hospital_name' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            Nama Rumah Sakit
                                            @if($sortBy == 'hospital_name')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Status</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => ($sortBy == 'created_at' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-dark d-flex align-items-center">
                                            Tanggal Dibuat
                                            @if($sortBy == 'created_at')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->hospital_name }}</td>
                                    <td>
                                        @if($client->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.trusted-clients.edit', $client->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.trusted-clients.destroy', $client->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus klien terpercaya ini?')">
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
                                    <td colspan="5" class="text-center">Belum ada klien terpercaya</td>
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
