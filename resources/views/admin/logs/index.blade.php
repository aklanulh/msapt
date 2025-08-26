@extends('admin.layouts.app')

@section('title', 'Log Aktivitas Admin - Admin Panel MSA')
@section('page-title', 'Log Aktivitas Admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Log Aktivitas Admin</h5>
                <div>
                    <span class="badge bg-primary">{{ $logs->total() }} Total Log</span>
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select class="form-select" id="actionFilter">
                            <option value="">Semua Aktivitas</option>
                            <option value="login">Login</option>
                            <option value="logout">Logout</option>
                            <option value="create">Tambah Produk</option>
                            <option value="update">Edit Produk</option>
                            <option value="delete">Hapus Produk</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="entityFilter">
                            <option value="">Semua Entity</option>
                            <option value="product">Produk</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="searchLog" placeholder="Cari dalam deskripsi...">
                    </div>
                </div>
                
                <!-- Logs Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Deskripsi</th>
                                <th>Entity</th>
                                <th>IP Address</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="logsTable">
                            @if($logs && count($logs) > 0)
                            @foreach($logs as $log)
                            <tr data-action="{{ $log->action }}" data-entity="{{ $log->entity_type ?? '' }}" data-description="{{ strtolower($log->description) }}">
                                <td>
                                    <div class="fw-bold">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $log->action_badge }}">
                                        {{ $log->action_text }}
                                    </span>
                                </td>
                                <td>{{ $log->description }}</td>
                                <td>
                                    @if($log->entity_type)
                                    <div class="fw-bold">{{ ucfirst($log->entity_type) }}</div>
                                    @if($log->entity_name)
                                    <small class="text-muted">{{ $log->entity_name }}</small>
                                    @endif
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $log->ip_address ?? '-' }}</small>
                                </td>
                                <td>
                                    @if($log->old_values || $log->new_values)
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#logDetailModal{{ $log->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada log aktivitas</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($logs->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $logs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Log Detail Modals -->
@foreach($logs as $log)
@if($log->old_values || $log->new_values)
<div class="modal fade" id="logDetailModal{{ $log->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Log - {{ $log->action_text }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Umum</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Waktu:</strong></td><td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td></tr>
                            <tr><td><strong>Aktivitas:</strong></td><td><span class="badge {{ $log->action_badge }}">{{ $log->action_text }}</span></td></tr>
                            <tr><td><strong>Deskripsi:</strong></td><td>{{ $log->description }}</td></tr>
                            <tr><td><strong>IP Address:</strong></td><td>{{ $log->ip_address ?? '-' }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        @if($log->entity_type)
                        <h6>Entity Information</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Type:</strong></td><td>{{ ucfirst($log->entity_type) }}</td></tr>
                            <tr><td><strong>ID:</strong></td><td>{{ $log->entity_id ?? '-' }}</td></tr>
                            <tr><td><strong>Name:</strong></td><td>{{ $log->entity_name ?? '-' }}</td></tr>
                        </table>
                        @endif
                    </div>
                </div>
                
                @if($log->old_values && $log->action === 'update')
                <hr>
                <h6>Perubahan Data</h6>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-danger">Data Lama</h6>
                        <pre class="bg-light p-2 small">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">Data Baru</h6>
                        <pre class="bg-light p-2 small">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
                @elseif($log->new_values && $log->action === 'create')
                <hr>
                <h6>Data yang Ditambahkan</h6>
                <pre class="bg-light p-2 small">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @elseif($log->old_values && $log->action === 'delete')
                <hr>
                <h6>Data yang Dihapus</h6>
                <pre class="bg-light p-2 small">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const actionFilter = document.getElementById('actionFilter');
    const entityFilter = document.getElementById('entityFilter');
    const searchLog = document.getElementById('searchLog');
    const logsTable = document.getElementById('logsTable');
    const rows = logsTable.querySelectorAll('tr');

    function filterLogs() {
        const selectedAction = actionFilter.value;
        const selectedEntity = entityFilter.value;
        const searchTerm = searchLog.value.toLowerCase();

        rows.forEach(row => {
            const action = row.dataset.action;
            const entity = row.dataset.entity;
            const description = row.dataset.description;
            
            const actionMatch = !selectedAction || action === selectedAction;
            const entityMatch = !selectedEntity || entity === selectedEntity;
            const descriptionMatch = !searchTerm || description.includes(searchTerm);
            
            if (actionMatch && entityMatch && descriptionMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    actionFilter.addEventListener('change', filterLogs);
    entityFilter.addEventListener('change', filterLogs);
    searchLog.addEventListener('input', filterLogs);
});
</script>
@endsection
