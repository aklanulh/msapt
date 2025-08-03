@extends('layouts.app')

@section('title', $article['title'] . ' - MSA Mitrajaya Selaras Abadi')
@section('description', $article['excerpt'])

@section('content')
<!-- Page Header -->
<section class="py-3" style="background-color: #f8f9fa;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $article['title'] }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Article Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article class="blog-post">
                    <!-- Article Header -->
                    <div class="text-center mb-5">
                        <span class="badge bg-primary mb-3">{{ $article['category'] }}</span>
                        <h1 class="display-5 fw-bold mb-4">{{ $article['title'] }}</h1>
                        <div class="article-meta text-muted">
                            <span class="me-4">
                                <i class="fas fa-user me-2"></i>{{ $article['author'] }}
                            </span>
                            <span class="me-4">
                                <i class="fas fa-calendar me-2"></i>{{ date('d M Y', strtotime($article['date'])) }}
                            </span>
                            <span>
                                <i class="fas fa-clock me-2"></i>{{ $article['read_time'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="featured-image mb-5">
                        <div class="d-flex align-items-center justify-content-center" style="height: 400px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%); border-radius: 10px;">
                            @if($article['category'] == 'Alat Kesehatan')
                                <i class="fas fa-heartbeat" style="font-size: 8rem; color: var(--primary-color);"></i>
                            @elseif($article['category'] == 'Alat Laboratorium')
                                <i class="fas fa-microscope" style="font-size: 8rem; color: var(--primary-color);"></i>
                            @elseif($article['category'] == 'Regulasi')
                                <i class="fas fa-gavel" style="font-size: 8rem; color: var(--primary-color);"></i>
                            @else
                                <i class="fas fa-newspaper" style="font-size: 8rem; color: var(--primary-color);"></i>
                            @endif
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $article['content'] !!}
                    </div>

                    <!-- Tags -->
                    <div class="article-tags mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Tags:</h6>
                        @foreach($article['tags'] as $tag)
                        <span class="badge bg-light text-dark me-2 mb-2">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Bagikan Artikel:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://wa.me/?text={{ urlencode($article['title'] . ' - ' . request()->url()) }}" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" class="btn btn-primary" target="_blank">
                                <i class="fab fa-facebook-f me-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article['title']) }}&url={{ urlencode(request()->url()) }}" class="btn btn-info" target="_blank">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" class="btn btn-secondary" target="_blank">
                                <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if(count($relatedArticles) > 0)
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h3 class="fw-bold text-center">Artikel Terkait</h3>
            </div>
        </div>
        <div class="row">
            @foreach($relatedArticles as $related)
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);">
                        <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title fw-bold">{{ $related['title'] }}</h6>
                        <small class="text-muted">{{ date('d M Y', strtotime($related['date'])) }}</small>
                        <div class="mt-3">
                            <a href="{{ route('blog.show', $related['slug']) }}" class="btn btn-outline-primary btn-sm">
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
@endif

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Butuh Konsultasi Lebih Lanjut?</h3>
                <p class="mb-0">Tim ahli kami siap membantu implementasi dan konsultasi seputar topik yang dibahas dalam artikel ini.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i>Konsultasi
                </a>
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20tertarik%20dengan%20artikel%20{{ urlencode($article['title']) }}" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-content h3 {
    color: var(--primary-color);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content ul li {
    margin-bottom: 0.5rem;
}

.share-buttons .btn {
    min-width: 120px;
}

@media (max-width: 768px) {
    .share-buttons .d-flex {
        flex-direction: column;
    }
    
    .share-buttons .btn {
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
