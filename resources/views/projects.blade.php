@extends('layouts.app')

@section('title', 'Klien & Proyek - MSA Mitrajaya Selaras Abadi')
@section('description', 'Galeri proyek dan klien MSA. Lihat dokumentasi lengkap implementasi alat kesehatan di berbagai rumah sakit dan institusi kesehatan di Indonesia.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Klien & Proyek <span class="badge bg-warning text-dark">Coming Soon</span></h1>
                <p class="lead">Dokumentasi proyek dan kemitraan dengan institusi kesehatan terpercaya</p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Isi halaman ini hanya ilustrasi. Konten lengkap akan segera tersedia.
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Project Gallery -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Galeri Proyek</h2>
                <p class="lead text-muted">Dokumentasi implementasi alat kesehatan di berbagai institusi</p>
            </div>
        </div>
        
        <!-- Filter Buttons -->
        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <div class="btn-group" role="group" aria-label="Project filters">
                    <button type="button" class="btn btn-outline-primary active" data-filter="all">Semua</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="alat-kesehatan">Alat Kesehatan</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="alat-laboratorium">Alat Laboratorium</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="alat-medis">Alat Medis</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="jasa-konsultan">Jasa Konsultan</button>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($projects as $project)
            <div class="col-lg-6 col-md-6 mb-4 project-item" data-category="{{ strtolower(str_replace(' ', '-', $project['category'])) }}">
                <div class="card h-100 border-0 shadow project-card">
                    <div class="card-img-top position-relative">
                        <div class="project-image d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                            @if(str_contains(strtolower($project['category']), 'kesehatan'))
                                <i class="fas fa-heartbeat" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @elseif(str_contains(strtolower($project['category']), 'laboratorium'))
                                <i class="fas fa-microscope" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @elseif(str_contains(strtolower($project['category']), 'medis'))
                                <i class="fas fa-stethoscope" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @else
                                <i class="fas fa-user-tie" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @endif
                        </div>
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary">{{ $project['year'] }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-secondary">{{ $project['category'] }}</span>
                        </div>
                        <h5 class="card-title fw-bold">{{ $project['title'] }}</h5>
                        <p class="text-muted mb-2"><i class="fas fa-building me-2"></i>{{ $project['client'] }}</p>
                        <p class="card-text">{{ $project['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project['id'] }}">
                                <i class="fas fa-images me-2"></i>Lihat Galeri
                            </button>
                            <a href="https://wa.me/6281194664700?text=Halo,%20saya%20tertarik%20dengan%20proyek%20{{ urlencode($project['title']) }}" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Diskusi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Modal -->
            <div class="modal fade" id="projectModal{{ $project['id'] }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="projectModalLabel{{ $project['id'] }}">{{ $project['title'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Klien:</strong> {{ $project['client'] }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Kategori:</strong> {{ $project['category'] }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Tahun:</strong> {{ $project['year'] }}
                                </div>
                            </div>
                            <p>{{ $project['description'] }}</p>
                            <div class="row">
                                @if($project['gallery'] && count($project['gallery']) > 0)
                                    @foreach($project['gallery'] as $index => $image)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Project Image {{ $index + 1 }}" style="height: 150px; width: 100%; object-fit: cover;">
                                    </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center">
                                        <div class="gallery-item d-flex align-items-center justify-content-center" style="height: 150px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%); border-radius: 10px;">
                                            <i class="fas fa-image" style="font-size: 3rem; color: var(--primary-color);"></i>
                                            <p class="ms-3 mb-0">Belum ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="https://wa.me/6281194664700?text=Halo,%20saya%20ingin%20konsultasi%20proyek%20serupa%20dengan%20{{ urlencode($project['title']) }}" class="btn btn-primary" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Konsultasi Proyek Serupa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Client Logos -->
<section class="py-5" style="background-color: #f8f9fa; overflow: hidden;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Klien Terpercaya</h2>
                <p class="lead text-muted">Institusi kesehatan yang telah mempercayai MSA</p>
            </div>
        </div>
        @if($trustedClients->count() > 0)
        <div class="clients-carousel-wrapper">
            <div class="clients-carousel d-flex align-items-center">
                @foreach($trustedClients as $client)
                <div class="client-item flex-shrink-0 text-center mx-4">
                    <div class="client-logo p-3">
                        <i class="fas fa-hospital" style="font-size: 3rem; color: var(--primary-color);"></i>
                        <p class="mt-2 mb-0 small">{{ $client->hospital_name }}</p>
                    </div>
                </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($trustedClients as $client)
                <div class="client-item flex-shrink-0 text-center mx-4">
                    <div class="client-logo p-3">
                        <i class="fas fa-hospital" style="font-size: 3rem; color: var(--primary-color);"></i>
                        <p class="mt-2 mb-0 small">{{ $client->hospital_name }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada klien terpercaya yang ditambahkan.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Siap Menjadi Klien Berikutnya?</h3>
                <p class="mb-0">Bergabunglah dengan ratusan institusi kesehatan yang telah mempercayai MSA untuk kebutuhan alat kesehatan mereka.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('rfq.create') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-file-alt me-2"></i>Mulai Proyek
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.project-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.clients-carousel-wrapper {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.clients-carousel {
    animation: scroll-left 60s linear infinite;
    white-space: nowrap;
    width: max-content;
}

.client-item {
    display: inline-block;
    min-width: 200px;
    vertical-align: top;
}

.client-logo {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.client-logo:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

@keyframes scroll-left {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.clients-carousel:hover {
    animation-play-state: paused;
}

@media (max-width: 768px) {
    .clients-carousel {
        animation-duration: 40s;
    }
    
    .client-item {
        min-width: 150px;
    }
}

.client-logo {
    transition: transform 0.3s ease;
}

.client-logo:hover {
    transform: scale(1.1);
}

.project-item {
    transition: opacity 0.3s ease;
}

.project-item.hidden {
    opacity: 0.3;
    pointer-events: none;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const projectItems = document.querySelectorAll('.project-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter projects
            projectItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
});
</script>
@endsection
