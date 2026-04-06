@extends('shop.layout')

@section('content')
<div class="mb-3">
    <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> Kembali ke Katalog</a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="row g-0">
        <!-- Kolom Gambar -->
        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400/e9ecef/495057?text=Kacamata' }}" class="img-fluid rounded shadow" alt="{{ $product->name }}" style="max-height: 400px; object-fit: contain;">
        </div>
        
        <!-- Kolom Info Produk -->
        <div class="col-md-7 p-4 p-md-5">
            <span class="badge bg-danger mb-2">{{ $product->category }}</span>
            <h2 class="fw-bold text-dark mb-2">{{ $product->name }}</h2>
            
            <div class="d-flex align-items-center mb-3">
                <div class="text-warning me-2">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                </div>
                <span class="text-muted small">| Stok Tersedia: <strong>{{ $product->stock }} Pcs</strong></span>
            </div>

            <h1 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h1>

            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Deskripsi Produk</h6>
            <p class="text-secondary" style="line-height: 1.8;">
                {!! nl2br(e($product->description)) !!}
            </p>

            <hr class="my-4">

            <!-- Tombol Beli -->
            @auth
                @if($product->stock > 0)
                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary btn-lg rounded-pill fw-bold px-5 shadow-sm">
                        <i class="bi bi-cart-plus me-2"></i> Masukkan Keranjang
                    </a>
                @else
                    <button class="btn btn-secondary btn-lg rounded-pill fw-bold px-5" disabled>Stok Habis</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg rounded-pill fw-bold px-5 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Membeli
                </a>
            @endauth
        </div>
    </div>
</div>
<!-- AREA ULASAN PRODUK ALA SHOPEE -->
<div class="row mt-4 mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <h4 class="fw-bold mb-4">Penilaian Produk</h4>

                <div class="row">
                    <!-- Form Tambah Ulasan (Kiri) -->
                    <div class="col-md-5 mb-4 mb-md-0 border-end pe-md-4">
                        @auth
                            <h6 class="fw-bold mb-3">Tulis Ulasan Anda</h6>
                            <form action="{{ route('review.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="small text-muted mb-1">Beri Rating Bintang</label>
                                    <select name="rating" class="form-select bg-light text-warning fw-bold" required>
                                        <option value="5">⭐⭐⭐⭐⭐ (5/5 Sangat Bagus)</option>
                                        <option value="4">⭐⭐⭐⭐ (4/5 Bagus)</option>
                                        <option value="3">⭐⭐⭐ (3/5 Lumayan)</option>
                                        <option value="2">⭐⭐ (2/5 Kurang)</option>
                                        <option value="1">⭐ (1/5 Sangat Kurang)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted mb-1">Komentar & Pengalaman</label>
                                    <textarea name="comment" class="form-control bg-light" rows="3" placeholder="Bagaimana kualitas frame dan lensanya?" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted mb-1">Upload Foto Produk (Opsional)</label>
                                    <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold">Kirim Ulasan</button>
                            </form>
                        @else
                            <div class="text-center py-5 bg-light rounded">
                                <i class="bi bi-lock fs-1 text-muted mb-2 d-block"></i>
                                <h6>Silakan Login untuk menulis ulasan</h6>
                                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-sm mt-2 rounded-pill px-4">Login Sekarang</a>
                            </div>
                        @endauth
                    </div>

                    <!-- Daftar Ulasan Pelanggan (Kanan) -->
                    <div class="col-md-7 ps-md-4">
                        <h6 class="fw-bold mb-3">Ulasan Pelanggan ({{ $product->reviews->count() }})</h6>
                        
                        @forelse($product->reviews()->latest()->get() as $review)
                            <div class="d-flex mb-4 pb-3 border-bottom">
                                <!-- Avatar -->
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=e62424&color=fff" class="rounded-circle me-3" width="45" height="45">
                                
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                    
                                    <!-- Bintang si pengulas -->
                                    <div class="text-warning small mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $review->rating ? '' : 'text-light' }}"></i>
                                        @endfor
                                        <span class="text-muted ms-2" style="font-size: 10px;">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>
                                    
                                    <!-- Komentar -->
                                    <p class="mb-2" style="font-size: 0.95rem;">{{ $review->comment }}</p>
                                    
                                    <!-- Foto Ulasan jika ada -->
                                    @if($review->image)
                                        <img src="{{ asset('storage/'.$review->image) }}" class="rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" alt="Foto Ulasan">
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-chat-square-text fs-1 opacity-50 mb-2 d-block"></i>
                                Belum ada ulasan untuk produk ini. Jadilah yang pertama!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection