@extends('layouts.app')

@section('title', 'Artikel & Blog - MSA Mitrajaya Selaras Abadi')
@section('description', 'Artikel edukatif dan tips seputar alat kesehatan, laboratorium, dan medis dari para ahli MSA. Dapatkan insight terbaru industri kesehatan.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Artikel & Blog <span class="badge bg-warning text-dark">Coming Soon</span></h1>
                <p class="lead">Insight dan edukasi seputar industri alat kesehatan dari para ahli</p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Isi halaman ini hanya ilustrasi. Konten lengkap akan segera tersedia.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Article -->
@if(count($articles) > 0)
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h2 class="fw-bold">Artikel Terbaru</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow featured-article">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 300px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        <i class="fas fa-newspaper" style="font-size: 6rem; color: var(--primary-color);"></i>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary">{{ $articles[0]['category'] }}</span>
                            <small class="text-muted">{{ date('d M Y', strtotime($articles[0]['date'])) }}</small>
                        </div>
                        <h3 class="card-title fw-bold">{{ $articles[0]['title'] }}</h3>
                        <p class="card-text text-muted">{{ $articles[0]['excerpt'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="author-info">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>{{ $articles[0]['author'] }}
                                    <i class="fas fa-clock ms-3 me-1"></i>{{ $articles[0]['read_time'] }}
                                </small>
                            </div>
                            <a href="{{ route('blog.show', $articles[0]['slug']) }}" class="btn btn-primary">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Kategori Artikel</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-heartbeat me-2 text-primary"></i>Alat Kesehatan
                                        <span class="badge bg-light text-dark ms-2">12</span>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-microscope me-2 text-primary"></i>Alat Laboratorium
                                        <span class="badge bg-light text-dark ms-2">8</span>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-stethoscope me-2 text-primary"></i>Alat Medis
                                        <span class="badge bg-light text-dark ms-2">15</span>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-gavel me-2 text-primary"></i>Regulasi
                                        <span class="badge bg-light text-dark ms-2">6</span>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-lightbulb me-2 text-primary"></i>Tips & Tricks
                                        <span class="badge bg-light text-dark ms-2">10</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Newsletter</h5>
                            <p class="text-muted small">Dapatkan artikel terbaru langsung di email Anda</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Anda" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Articles Grid -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h2 class="fw-bold">Semua Artikel</h2>
            </div>
        </div>
        <div class="row">
            @foreach($articles as $article)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow article-card">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        @if($article['category'] == 'Alat Kesehatan')
                            <i class="fas fa-heartbeat" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($article['category'] == 'Alat Laboratorium')
                            <i class="fas fa-microscope" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @elseif($article['category'] == 'Regulasi')
                            <i class="fas fa-gavel" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @else
                            <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--primary-color);"></i>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary">{{ $article['category'] }}</span>
                            <small class="text-muted">{{ date('d M Y', strtotime($article['date'])) }}</small>
                        </div>
                        <h5 class="card-title fw-bold">{{ $article['title'] }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ $article['excerpt'] }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>{{ $article['author'] }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>{{ $article['read_time'] }}
                                </small>
                            </div>
                            <a href="{{ route('blog.show', $article['slug']) }}" class="btn btn-outline-primary w-100">
                                Baca Artikel <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Popular Topics -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Topik Populer</h2>
                <p class="lead text-muted">Topik yang paling banyak dicari dan dibaca</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-cogs" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Maintenance Alat</h5>
                    <p class="text-muted">Tips perawatan dan maintenance alat kesehatan agar awet dan akurat.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-balance-scale" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kalibrasi</h5>
                    <p class="text-muted">Panduan kalibrasi alat medis sesuai standar dan regulasi yang berlaku.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Keamanan</h5>
                    <p class="text-muted">Protokol keamanan dan safety dalam penggunaan alat kesehatan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-chart-line" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Teknologi Terbaru</h5>
                    <p class="text-muted">Update teknologi terbaru dalam dunia alat kesehatan dan medis.</p>
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
                <h3 class="mb-3">Butuh Konsultasi Teknis?</h3>
                <p class="mb-0">Tim ahli kami siap membantu menjawab pertanyaan teknis seputar alat kesehatan dan implementasinya.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i>Hubungi Ahli
                </a>
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20butuh%20konsultasi%20teknis%20dari%20MSA" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.article-card, .featured-article {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article-card:hover, .featured-article:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.sidebar .list-unstyled a {
    color: var(--text-dark);
    transition: color 0.3s ease;
}

.sidebar .list-unstyled a:hover {
    color: var(--primary-color);
}
</style>
@endsection
