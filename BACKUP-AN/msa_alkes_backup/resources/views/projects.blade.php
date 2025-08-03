@extends('layouts.app')

@section('title', 'Klien & Proyek - MSA Mitrajaya Selaras Abadi')
@section('description', 'Galeri proyek dan klien MSA. Lihat dokumentasi lengkap implementasi alat kesehatan di berbagai rumah sakit dan institusi kesehatan di Indonesia.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Klien & Proyek</h1>
                <p class="lead">Dokumentasi proyek dan kemitraan dengan institusi kesehatan terpercaya</p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="py-5" style="background-color: var(--secondary-color);">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $stats['total_projects'] }}+</h2>
                    <p class="mb-0 fw-bold">Proyek Selesai</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $stats['satisfied_clients'] }}+</h2>
                    <p class="mb-0 fw-bold">Klien Puas</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $stats['years_experience'] }}</h2>
                    <p class="mb-0 fw-bold">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $stats['total_value'] }}</h2>
                    <p class="mb-0 fw-bold">Total Nilai Proyek</p>
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
                            <span class="text-primary fw-bold">{{ $project['value'] }}</span>
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
                                <div class="col-md-6">
                                    <strong>Nilai Proyek:</strong> {{ $project['value'] }}
                                </div>
                            </div>
                            <p>{{ $project['description'] }}</p>
                            <div class="row">
                                @foreach($project['gallery'] as $index => $image)
                                <div class="col-md-4 mb-3">
                                    <div class="gallery-item d-flex align-items-center justify-content-center" style="height: 150px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%); border-radius: 10px;">
                                        <i class="fas fa-image" style="font-size: 3rem; color: var(--primary-color);"></i>
                                    </div>
                                </div>
                                @endforeach
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
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Klien Terpercaya</h2>
                <p class="lead text-muted">Institusi kesehatan yang telah mempercayai MSA</p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-hospital" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">RS Husada Jakarta</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-clinic-medical" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">RSUD Tangerang</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-hospital-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">RS Permata Bekasi</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-building" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">Dinkes Kota Depok</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-hospital-user" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">RS Siloam</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
                <div class="client-logo p-3">
                    <i class="fas fa-plus-square" style="font-size: 3rem; color: var(--primary-color);"></i>
                    <p class="mt-2 mb-0 small">RS Mayapada</p>
                </div>
            </div>
        </div>
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
