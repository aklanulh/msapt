@extends('admin.layout')

@section('title', 'Pesan Kontak')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">📧 Pesan Kontak</h3>
                    <div class="card-tools">
                        <span class="badge badge-info">Total: {{ $contacts->total() }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter & Search -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.contacts') }}" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari nama, email, perusahaan..." 
                                           value="{{ $search }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            🔍 Cari
                                        </button>
                                    </div>
                                </div>
                                @if($search)
                                    <a href="{{ route('admin.contacts') }}" class="btn btn-link">Clear</a>
                                @endif
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group float-right" role="group">
                                <a href="{{ route('admin.contacts', ['status' => 'all']) }}" 
                                   class="btn btn-sm {{ $status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Semua
                                </a>
                                <a href="{{ route('admin.contacts', ['status' => 'unread']) }}" 
                                   class="btn btn-sm {{ $status === 'unread' ? 'btn-warning' : 'btn-outline-warning' }}">
                                    Belum Dibaca
                                </a>
                                <a href="{{ route('admin.contacts', ['status' => 'read']) }}" 
                                   class="btn btn-sm {{ $status === 'read' ? 'btn-success' : 'btn-outline-success' }}">
                                    Sudah Dibaca
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($contacts->count() > 0)
                        <!-- Bulk Actions -->
                        <form id="bulk-form" method="POST" action="{{ route('admin.contacts.bulk-action') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select name="action" class="form-control" required>
                                            <option value="">Pilih Aksi...</option>
                                            <option value="mark_read">Tandai Sebagai Dibaca</option>
                                            <option value="mark_unread">Tandai Sebagai Belum Dibaca</option>
                                            <option value="delete">Hapus</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary">Jalankan</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="select-all"> Pilih Semua
                                    </label>
                                </div>
                            </div>

                            <!-- Contact List -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" id="select-all-header"></th>
                                            <th>Status</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Perusahaan</th>
                                            <th>Subjek</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            <tr class="{{ !$contact->isRead() ? 'table-warning' : '' }}">
                                                <td>
                                                    <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" class="contact-checkbox">
                                                </td>
                                                <td>
                                                    @if($contact->isRead())
                                                        <span class="badge badge-success">✓ Dibaca</span>
                                                    @else
                                                        <span class="badge badge-warning">● Baru</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $contact->name }}</strong>
                                                    <br><small class="text-muted">{{ $contact->phone }}</small>
                                                </td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->company ?: '-' }}</td>
                                                <td>
                                                    <span title="{{ $contact->subject }}">
                                                        {{ Str::limit($contact->subject, 30) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $contact->created_at->format('d/m/Y H:i') }}
                                                    <br><small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                                           class="btn btn-info" title="Lihat Detail">
                                                            👁️
                                                        </a>
                                                        @if($contact->isRead())
                                                            <button type="button" class="btn btn-warning mark-unread" 
                                                                    data-id="{{ $contact->id }}" title="Tandai Belum Dibaca">
                                                                ↶
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-success mark-read" 
                                                                    data-id="{{ $contact->id }}" title="Tandai Dibaca">
                                                                ✓
                                                            </button>
                                                        @endif
                                                        <button type="button" class="btn btn-danger delete-contact" 
                                                                data-id="{{ $contact->id }}" title="Hapus">
                                                            🗑️
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $contacts->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>Tidak ada pesan kontak</h5>
                            <p class="text-muted">
                                @if($search)
                                    Tidak ditemukan pesan kontak yang sesuai dengan pencarian "{{ $search }}"
                                @elseif($status === 'unread')
                                    Semua pesan kontak sudah dibaca
                                @elseif($status === 'read')
                                    Belum ada pesan kontak yang dibaca
                                @else
                                    Belum ada pesan kontak masuk
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Select All functionality
    $('#select-all, #select-all-header').change(function() {
        $('.contact-checkbox').prop('checked', this.checked);
    });

    $('.contact-checkbox').change(function() {
        if ($('.contact-checkbox:checked').length === $('.contact-checkbox').length) {
            $('#select-all, #select-all-header').prop('checked', true);
        } else {
            $('#select-all, #select-all-header').prop('checked', false);
        }
    });

    // Mark as Read/Unread
    $('.mark-read').click(function() {
        const id = $(this).data('id');
        $.post(`/admin/contacts/${id}/mark-read`, {
            _token: '{{ csrf_token() }}'
        }).done(function() {
            location.reload();
        });
    });

    $('.mark-unread').click(function() {
        const id = $(this).data('id');
        $.post(`/admin/contacts/${id}/mark-unread`, {
            _token: '{{ csrf_token() }}'
        }).done(function() {
            location.reload();
        });
    });

    // Delete Contact
    $('.delete-contact').click(function() {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus pesan kontak ini?')) {
            $('#delete-form').attr('action', `/admin/contacts/${id}`).submit();
        }
    });

    // Bulk Form Validation
    $('#bulk-form').submit(function(e) {
        if ($('.contact-checkbox:checked').length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu pesan kontak.');
            return false;
        }
        
        const action = $('select[name="action"]').val();
        if (action === 'delete') {
            if (!confirm('Yakin ingin menghapus pesan kontak yang dipilih?')) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>
@endsection
