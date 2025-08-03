@extends('layouts.app')

@section('title', 'Tentang Kami - MSA Mitrajaya Selaras Abadi')
@section('description', 'Mengenal lebih dekat PT Mitrajaya Selaras Abadi - Visi, misi, sejarah, dan legalitas perusahaan penyedia alat kesehatan terpercaya di Indonesia.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat PT Mitrajaya Selaras Abadi</p>
            </div>
        </div>
    </div>
</section>

<!-- Company Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">PT Mitrajaya Selaras Abadi</h2>
                <p class="lead mb-4">Distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit dengan komitmen tinggi terhadap kualitas dan pelayanan.</p>
                
                <div class="mb-4">
                    <p>PT. Mitrajaya Selaras Abadi (MSA) adalah perusahaan distributor dan subdistributor alat kesehatan serta perlengkapan rumah sakit yang berdiri dengan komitmen tinggi terhadap kualitas dan pelayanan. Kami menyediakan produk-produk kesehatan impor berkualitas tinggi yang telah memenuhi standar internasional dan digunakan oleh berbagai rumah sakit ternama di Indonesia.</p>
                    
                    <p>MSA hadir sebagai solusi kebutuhan alat kesehatan untuk rumah sakit, klinik, hingga individu, dengan harga kompetitif dan layanan purna jual berupa <strong>garansi 1 tahun untuk sparepart dan servis</strong>. Didukung oleh tenaga profesional dan sistem yang terkoordinasi, kami terus berupaya berkontribusi dalam mendukung pembangunan sektor kesehatan di era globalisasi.</p>
                    
                    <p>Kami terbuka untuk menjalin kerja sama strategis yang saling menguntungkan, dengan harapan setiap hasil kerja kami mampu memberikan kepuasan maksimal bagi seluruh mitra dan pelanggan.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Garansi 1 Tahun</h6>
                                <small class="text-muted">Sparepart & Servis</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-certificate text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Standar Internasional</h6>
                                <small class="text-muted">Produk Berkualitas Tinggi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="{{ asset('images/foto_gedung_tentang_kami.png') }}" alt="Gedung Kantor MSA" class="img-fluid rounded shadow-lg" style="max-height: 400px; width: 100%; object-fit: cover;">
                    <p class="text-muted mt-3"><small>Kantor Pusat MSA - Ruko Maison Avenue MA.19, Kota Wisata, Cibubur</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <img src="{{ asset('images/foto_gedung_tentang_kami.png') }}" alt="Fasilitas MSA" class="img-fluid rounded shadow" style="max-height: 300px; width: 100%; object-fit: cover; filter: sepia(20%);">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="fw-bold mb-3">Strategis</h3>
                        <p>Kantor pusat MSA berlokasi strategis di Kota Wisata, Cibubur. Lokasi yang mudah diakses memungkinkan kami melayani klien di seluruh Jabodetabek dan Indonesia dengan efisien.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Lokasi strategis di Cibubur</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Akses mudah dari berbagai wilayah</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Ruang meeting dan konsultasi</li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="text-center">
                            <h3 class="fw-bold" style="color: var(--primary-color);">80+</h3>
                            <p class="mb-0">Institusi Terpercaya</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <h3 class="fw-bold" style="color: var(--primary-color);">14</h3>
                            <p class="mb-0">Tahun Pengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="p-5">
                    <i class="fas fa-building" style="font-size: 10rem; color: var(--secondary-color);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-eye" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi Kami</h3>
                        <p class="text-center">{{ $companyInfo['vision'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-bullseye" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi Kami</h3>
                        <ul class="list-unstyled">
                            @foreach($companyInfo['mission'] as $mission)
                            <li class="mb-2">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i>
                                {{ $mission }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company History -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Sejarah Perusahaan</h2>
                <p class="lead text-muted">Perjalanan MSA dalam melayani industri kesehatan Indonesia</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="timeline">
                    @foreach($companyInfo['history'] as $index => $history)
                    <div class="row mb-4">
                        <div class="col-lg-2 col-md-3">
                            <div class="year-badge bg-primary text-white text-center py-2 rounded fw-bold">
                                {{ $history['year'] }}
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-9">
                            <div class="card border-start border-primary border-4">
                                <div class="card-body">
                                    <p class="mb-0">{{ $history['event'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Legal Information -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Legalitas Perusahaan</h2>
                <p class="lead text-muted">Informasi legal dan sertifikasi perusahaan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <strong>Nama Perusahaan:</strong><br>
                                {{ $companyInfo['legal']['company_name'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Registrasi:</strong><br>
                                {{ $companyInfo['legal']['registration'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Dokumen Legal:</strong><br>
                                {{ $companyInfo['legal']['documents'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Alamat:</strong><br>
                                {{ $companyInfo['legal']['address'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Telepon:</strong><br>
                                {{ $companyInfo['legal']['phone'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>WhatsApp:</strong><br>
                                {{ $companyInfo['legal']['whatsapp'] }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Website:</strong><br>
                                {{ $companyInfo['legal']['website'] }}
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Email:</strong><br>
                                @foreach($companyInfo['legal']['emails'] as $email)
                                    {{ $email }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Values -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Nilai-Nilai Perusahaan</h2>
                <p class="lead text-muted">Prinsip yang menjadi fondasi dalam setiap layanan kami</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Integritas</h5>
                    <p class="text-muted">Berkomitmen pada kejujuran dan transparansi dalam setiap transaksi bisnis.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-star" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kualitas</h5>
                    <p class="text-muted">Mengutamakan kualitas produk dan layanan terbaik untuk kepuasan klien.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-lightbulb" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Inovasi</h5>
                    <p class="text-muted">Terus berinovasi untuk memberikan solusi terdepan dalam industri kesehatan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-handshake" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kemitraan</h5>
                    <p class="text-muted">Membangun hubungan kemitraan yang saling menguntungkan dan berkelanjutan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Profesionalisme</h5>
                    <p class="text-muted">Tim profesional dengan keahlian tinggi dalam bidang alat kesehatan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-heart" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Kepedulian</h5>
                    <p class="text-muted">Peduli terhadap peningkatan kualitas layanan kesehatan di Indonesia.</p>
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
                <h3 class="mb-3">Ingin Mengetahui Lebih Lanjut?</h3>
                <p class="mb-0">Hubungi tim kami untuk konsultasi dan informasi lebih detail tentang produk dan layanan MSA.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20ingin%20mengetahui%20lebih%20lanjut%20tentang%20MSA" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
