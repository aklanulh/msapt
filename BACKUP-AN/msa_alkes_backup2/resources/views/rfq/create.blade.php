@extends('layouts.app')

@section('title', 'Request for Quotation (RFQ) - MSA Mitrajaya Selaras Abadi')
@section('description', 'Ajukan permintaan penawaran untuk kebutuhan alat kesehatan institusi Anda. Dapatkan penawaran terbaik dari MSA dalam 1x24 jam.')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Request for Quotation</h1>
                <p class="lead">Dapatkan penawaran terbaik untuk kebutuhan alat kesehatan institusi Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- RFQ Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('rfq.store') }}" method="POST">
                            @csrf
                            
                            <!-- Company Information -->
                            <div class="section-header mb-4">
                                <h4 class="fw-bold text-primary">
                                    <i class="fas fa-building me-2"></i>Informasi Perusahaan
                                </h4>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name" class="form-label">Nama Perusahaan/Institusi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_person" class="form-label">Nama Kontak Person <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                                    @error('contact_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Information -->
                            <div class="section-header mb-4 mt-5">
                                <h4 class="fw-bold text-primary">
                                    <i class="fas fa-boxes me-2"></i>Informasi Produk
                                </h4>
                                <hr>
                            </div>

                            @if($product)
                            <div class="alert alert-info">
                                <h6 class="fw-bold">Produk yang dipilih:</h6>
                                <p class="mb-0">{{ $product['name'] }} - {{ $product['brand'] }} {{ $product['model'] }}</p>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="product_category" class="form-label">Kategori Produk <span class="text-danger">*</span></label>
                                    <select class="form-select @error('product_category') is-invalid @enderror" id="product_category" name="product_category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="alat-kesehatan" {{ old('product_category', $product['category'] ?? '') == 'alat-kesehatan' ? 'selected' : '' }}>Alat Kesehatan</option>
                                        <option value="alat-laboratorium" {{ old('product_category', $product['category'] ?? '') == 'alat-laboratorium' ? 'selected' : '' }}>Alat Laboratorium</option>
                                        <option value="alat-medis" {{ old('product_category', $product['category'] ?? '') == 'alat-medis' ? 'selected' : '' }}>Alat Medis</option>
                                        <option value="jasa-konsultan" {{ old('product_category', $product['category'] ?? '') == 'jasa-konsultan' ? 'selected' : '' }}>Jasa Konsultan</option>
                                    </select>
                                    @error('product_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Jumlah/Kuantitas <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="product_details" class="form-label">Detail Produk yang Dibutuhkan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('product_details') is-invalid @enderror" id="product_details" name="product_details" rows="4" placeholder="Sebutkan nama produk, brand, model, spesifikasi khusus yang dibutuhkan..." required>{{ old('product_details', $product ? $product['name'] . ' - ' . $product['brand'] . ' ' . $product['model'] : '') }}</textarea>
                                @error('product_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Project Information -->
                            <div class="section-header mb-4 mt-5">
                                <h4 class="fw-bold text-primary">
                                    <i class="fas fa-project-diagram me-2"></i>Informasi Proyek
                                </h4>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="budget_range" class="form-label">Range Budget</label>
                                    <select class="form-select @error('budget_range') is-invalid @enderror" id="budget_range" name="budget_range">
                                        <option value="">Pilih Range Budget</option>
                                        <option value="< 50 juta" {{ old('budget_range') == '< 50 juta' ? 'selected' : '' }}>< Rp 50 Juta</option>
                                        <option value="50-100 juta" {{ old('budget_range') == '50-100 juta' ? 'selected' : '' }}>Rp 50 - 100 Juta</option>
                                        <option value="100-500 juta" {{ old('budget_range') == '100-500 juta' ? 'selected' : '' }}>Rp 100 - 500 Juta</option>
                                        <option value="500 juta - 1 miliar" {{ old('budget_range') == '500 juta - 1 miliar' ? 'selected' : '' }}>Rp 500 Juta - 1 Miliar</option>
                                        <option value="> 1 miliar" {{ old('budget_range') == '> 1 miliar' ? 'selected' : '' }}>> Rp 1 Miliar</option>
                                    </select>
                                    @error('budget_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="delivery_timeline" class="form-label">Timeline Pengiriman <span class="text-danger">*</span></label>
                                    <select class="form-select @error('delivery_timeline') is-invalid @enderror" id="delivery_timeline" name="delivery_timeline" required>
                                        <option value="">Pilih Timeline</option>
                                        <option value="Segera (1-2 minggu)" {{ old('delivery_timeline') == 'Segera (1-2 minggu)' ? 'selected' : '' }}>Segera (1-2 minggu)</option>
                                        <option value="1 bulan" {{ old('delivery_timeline') == '1 bulan' ? 'selected' : '' }}>1 Bulan</option>
                                        <option value="2-3 bulan" {{ old('delivery_timeline') == '2-3 bulan' ? 'selected' : '' }}>2-3 Bulan</option>
                                        <option value="3-6 bulan" {{ old('delivery_timeline') == '3-6 bulan' ? 'selected' : '' }}>3-6 Bulan</option>
                                        <option value="Fleksibel" {{ old('delivery_timeline') == 'Fleksibel' ? 'selected' : '' }}>Fleksibel</option>
                                    </select>
                                    @error('delivery_timeline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="additional_requirements" class="form-label">Kebutuhan Tambahan</label>
                                <textarea class="form-control @error('additional_requirements') is-invalid @enderror" id="additional_requirements" name="additional_requirements" rows="3" placeholder="Instalasi, training, maintenance, garansi extended, dll...">{{ old('additional_requirements') }}</textarea>
                                @error('additional_requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Terms and Submit -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agree_terms" required>
                                    <label class="form-check-label" for="agree_terms">
                                        Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a> yang berlaku dan memberikan informasi yang akurat.
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Permintaan Penawaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Information -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h3 class="fw-bold">Proses Setelah RFQ Dikirim</h3>
                <p class="text-muted">Langkah-langkah yang akan kami lakukan setelah menerima RFQ Anda</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fw-bold" style="font-size: 1.5rem;">1</span>
                    </div>
                    <h5 class="fw-bold">Review RFQ</h5>
                    <p class="text-muted">Tim kami akan mereview kebutuhan Anda dalam 2-4 jam kerja.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fw-bold" style="font-size: 1.5rem;">2</span>
                    </div>
                    <h5 class="fw-bold">Konsultasi</h5>
                    <p class="text-muted">Sales engineer kami akan menghubungi untuk klarifikasi dan konsultasi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fw-bold" style="font-size: 1.5rem;">3</span>
                    </div>
                    <h5 class="fw-bold">Penawaran</h5>
                    <p class="text-muted">Penawaran detail dengan spesifikasi dan harga akan dikirim dalam 1x24 jam.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fw-bold" style="font-size: 1.5rem;">4</span>
                    </div>
                    <h5 class="fw-bold">Follow Up</h5>
                    <p class="text-muted">Tim kami akan melakukan follow up untuk memastikan kepuasan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Alternative -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #003d7a 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Butuh Bantuan Mengisi RFQ?</h3>
                <p class="mb-0">Tim kami siap membantu Anda mengisi RFQ atau memberikan konsultasi langsung via WhatsApp atau telepon.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="https://wa.me/6281194664700?text=Halo,%20saya%20butuh%20bantuan%20untuk%20RFQ" class="btn btn-success btn-lg me-3" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
                <a href="tel:+622112345678" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-phone me-2"></i>Telepon
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
