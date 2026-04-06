@extends('shop.layout')

@section('content')

<!-- Banner Promo Amalia -->
@if(!request('search') && !request('category'))
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #e62424, #ff5e5e);">
            <div class="card-body p-4 p-md-5 d-flex align-items-center justify-content-between text-white">
                <div class="ps-md-3">
                    <span class="badge bg-white text-danger fw-bold px-3 py-2 mb-3 fs-6 rounded-pill">PROMO SPESIAL</span>
                    <h1 class="fw-bold mb-2" style="font-size: 2.5rem;">Paket Frame + Lensa</h1>
                    <p class="fs-4 mb-4">Start from : <strong class="text-warning fs-2">Rp 150.000,-</strong></p>
                    <a href="#produk" class="btn btn-light text-danger btn-lg fw-bold px-5 rounded-pill shadow-sm">Belanja Sekarang <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="d-none d-md-block opacity-75 pe-md-5">
                    <i class="bi bi-eyeglasses" style="font-size: 10rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row" id="produk">
    <!-- Sidebar Kategori Kiri -->
    <div class="col-md-2 d-none d-md-block">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body category-list">
                <h6 class="fw-bold mb-3"><i class="bi bi-list-ul"></i> Kategori Utama</h6>
                <a href="{{ route('home') }}" class="{{ !request('category') ? 'text-primary fw-bold' : '' }}">Semua Produk</a>
                @foreach($categories as $c)
                    <a href="{{ route('home', ['category' => $c->category]) }}" class="{{ request('category') == $c->category ? 'text-primary fw-bold' : '' }}">
                        {{ $c->category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Grid Produk Kanan -->
    <div class="col-md-10">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">
                @if(request('search'))
                    Hasil pencarian: "{{ request('search') }}"
                @elseif(request('category'))
                    Kategori: {{ request('category') }}
                @else
                    Produk Pilihan Kami
                @endif
            </h5>
        </div>

        <div class="row g-3">
            @forelse($products as $p)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100 bg-white">
                    <!-- GAMBAR BISA DIKLIK -->
                    <a href="{{ route('product.show', $p->id) }}">
                        <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://placehold.co/400x300/e9ecef/495057?text=Kacamata' }}" class="card-img-top p-2" alt="{{ $p->name }}" style="object-fit: cover; height: 180px;">
                    </a>
                    
                    <div class="card-body p-3 d-flex flex-column">
                        <small class="text-muted mb-1">{{ $p->category }}</small>
                        
                        <!-- JUDUL BISA DIKLIK -->
                        <a href="{{ route('product.show', $p->id) }}" class="text-decoration-none text-dark">
                            <h6 class="card-title text-truncate mb-2 fw-bold" title="{{ $p->name }}">{{ $p->name }}</h6>
                        </a>
                        
                       <!-- Rating Realtime Asli -->
                        @php
                            $avg_rating = $p->reviews->avg('rating') ?: 0; // Hitung rata-rata bintang
                            $total_reviews = $p->reviews->count();
                        @endphp
                        
                        <div class="mb-2" style="font-size: 0.8rem;">
                            <div class="text-warning d-inline-block">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $avg_rating)
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($i - 0.5 <= $avg_rating)
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted ms-1">({{ $total_reviews }} Ulasan)</span>
                        </div>
                        
                        <div class="mt-auto">
                            <div class="price-text mb-2">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                            
                            <!-- LOGIKA CEK LOGIN -->
                            @auth
                                <!-- Jika sudah login, tombol berfungsi normal -->
                                <a href="{{ route('add.to.cart', $p->id) }}" class="btn btn-outline-primary w-100 btn-sm rounded-pill fw-bold">
                                    <i class="bi bi-cart-plus"></i> Masukkan Keranjang
                                </a>
                            @else
                                <!-- Jika BELUM login, arahkan ke halaman Login -->
                                <a href="{{ route('login') }}" class="btn btn-outline-danger w-100 btn-sm rounded-pill fw-bold">
                                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Membeli
                                </a>
                            @endauth
                            <!-- END LOGIKA CEK LOGIN -->

                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" width="100" class="opacity-50 mb-3">
                <h5 class="text-muted">Oops, Produk tidak ditemukan!</h5>
                <a href="{{ route('home') }}" class="btn btn-primary mt-2">Kembali ke Beranda</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection