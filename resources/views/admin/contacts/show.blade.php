@extends('admin.layout')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        📧 Detail Pesan Kontak
                        @if($contact->isRead())
                            <span class="badge badge-success ml-2">✓ Dibaca</span>
                        @else
                            <span class="badge badge-warning ml-2">● Baru</span>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contacts') }}" class="btn btn-secondary btn-sm">
                            ← Kembali ke Daftar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">👤 Informasi Pengirim</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>{{ $contact->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>
                                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telepon:</strong></td>
                                            <td>
                                                <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Perusahaan:</strong></td>
                                            <td>{{ $contact->company ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Subjek:</strong></td>
                                            <td><strong>{{ $contact->subject }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Message Details -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">📅 Informasi Pesan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Diterima:</strong></td>
                                            <td>
                                                {{ $contact->created_at->format('d F Y, H:i') }} WIB
                                                <br><small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                            </td>
                                        </tr>
                                        @if($contact->isRead())
                                            <tr>
                                                <td><strong>Dibaca:</strong></td>
                                                <td>
                                                    {{ $contact->read_at->format('d F Y, H:i') }} WIB
                                                    <br><small class="text-muted">{{ $contact->read_at->diffForHumans() }}</small>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($contact->isRead())
                                                    <span class="badge badge-success">✓ Sudah Dibaca</span>
                                                @else
                                                    <span class="badge badge-warning">● Belum Dibaca</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">💬 Isi Pesan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="message-content p-3" style="background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 4px; white-space: pre-wrap; font-family: inherit;">{{ $contact->message }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">⚡ Aksi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group mr-2">
                                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                                           class="btn btn-primary">
                                            📧 Balas via Email
                                        </a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}?text=Halo {{ $contact->name }}, terima kasih atas pesan Anda mengenai: {{ $contact->subject }}" 
                                           target="_blank" class="btn btn-success">
                                            📱 Balas via WhatsApp
                                        </a>
                                    </div>

                                    <div class="btn-group mr-2">
                                        @if($contact->isRead())
                                            <button type="button" class="btn btn-warning mark-unread" data-id="{{ $contact->id }}">
                                                ↶ Tandai Belum Dibaca
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success mark-read" data-id="{{ $contact->id }}">
                                                ✓ Tandai Dibaca
                                            </button>
                                        @endif
                                    </div>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger delete-contact" data-id="{{ $contact->id }}">
                                            🗑️ Hapus Pesan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact History (if there are multiple messages from same email) -->
                    @php
                        $otherMessages = \App\Models\Contact::where('email', $contact->email)
                                                          ->where('id', '!=', $contact->id)
                                                          ->orderBy('created_at', 'desc')
                                                          ->limit(5)
                                                          ->get();
                    @endphp

                    @if($otherMessages->count() > 0)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">📋 Pesan Lain dari {{ $contact->email }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Subjek</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($otherMessages as $msg)
                                                        <tr>
                                                            <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                                            <td>{{ Str::limit($msg->subject, 40) }}</td>
                                                            <td>
                                                                @if($msg->isRead())
                                                                    <span class="badge badge-success badge-sm">Dibaca</span>
                                                                @else
                                                                    <span class="badge badge-warning badge-sm">Baru</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.contacts.show', $msg->id) }}" 
                                                                   class="btn btn-info btn-sm">Lihat</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
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
        if (confirm('Yakin ingin menghapus pesan kontak ini?')) {
            $('#delete-form').submit();
        }
    });
});
</script>
@endsection
