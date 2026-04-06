<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amalia Eyewear - Since 1996</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- CSS Custom Tema Amalia (Merah) -->
    <style>
        :root {
            --bs-primary: #e62424; /* Warna Merah Amalia */
            --bs-primary-rgb: 230, 36, 36;
        }
        body { background-color: #f8f9fa; }
        .btn-primary { background-color: #e62424; border-color: #e62424; color: white; }
        .btn-primary:hover { background-color: #c91f1f; border-color: #c91f1f; }
        .btn-outline-primary { color: #e62424; border-color: #e62424; }
        .btn-outline-primary:hover { background-color: #e62424; color: white; }
        .text-primary { color: #e62424 !important; }
        .bg-primary { background-color: #e62424 !important; }
        
        .navbar-brand img { height: 40px; object-fit: contain; }
        .search-bar { border-radius: 8px 0 0 8px; }
        .search-btn { border-radius: 0 8px 8px 0; }
        .product-card { transition: transform 0.2s, box-shadow 0.2s; border: none; border-radius: 8px; overflow: hidden; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .price-text { color: #e62424; font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-2">
        <div class="container">
            <!-- Logo Amalia -->
            <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">
                <!-- Pastikan gambar logo.png ada di folder public/images/ -->
                <img src="{{ asset('images/logo.png') }}" alt="Amalia Eyewear">
            </a>

            <!-- Search Bar -->
            <form action="{{ route('home') }}" method="GET" class="d-flex mx-auto w-50">
                <input class="form-control search-bar bg-light" type="search" name="search" value="{{ request('search') }}" placeholder="Cari Frame, Lensa..." aria-label="Search">
                <button class="btn btn-primary search-btn px-4" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <!-- Menu Kanan -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('cart') }}" class="position-relative text-dark text-decoration-none fs-5">
                    <i class="bi bi-cart3"></i>
                    @if(session('cart'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <div class="vr mx-2"></div>

                @auth
                    @if(auth()->user()->role === 'super_admin')
                        <a href="{{ route('admin.orders') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                            <i class="bi bi-laptop"></i> Panel Admin
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle border-0 fw-bold" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle text-primary"></i> {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-bag-check text-primary me-2"></i> Pesanan Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-bold">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill fw-bold">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4 mb-5 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Footer Amalia Eyewear -->
    <footer class="bg-dark text-light pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row">
                <!-- Info Brand -->
                <div class="col-md-5 mb-4">
                    <h4 class="fw-bold mb-3">
                        <img src="{{ asset('images/logo.png') }}" height="35" class="me-2 bg-white p-1 rounded"> 
                        Amalia Eyewear
                    </h4>
                    <p class="text-secondary">Sejak 1996 melayani penglihatan terbaik Anda dengan produk berkualitas dan harga terjangkau.</p>
                    <a href="https://instagram.com/optikalamalia" target="_blank" class="text-light text-decoration-none fs-5">
                        <i class="bi bi-instagram text-danger"></i> @optikalamalia
                    </a>
                </div>

                <!-- Cabang Toko -->
                <div class="col-md-7 mb-4">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">📍 Kunjungi Cabang Kami</h5>
                    <div class="row text-secondary small">
                        <div class="col-sm-6 mb-3">
                            <h6 class="text-light fw-bold mb-1">Cabang Jatiuwung</h6>
                            Jalan Pasar Jati Baru,<br>Jatiuwung, Tangerang
                        </div>
                        <div class="col-sm-6 mb-3">
                            <h6 class="text-light fw-bold mb-1">Cabang Tigaraksa</h6>
                            Jl. Nusa Indah Raya,<br>Tigaraksa, Tangerang
                        </div>
                        <div class="col-sm-6 mb-3">
                            <h6 class="text-light fw-bold mb-1">Cabang Sepatan</h6>
                            Perum Permata Sepatan,<br>Tangerang
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center text-secondary small">
                &copy; {{ date('Y') }} Amalia Eyewear. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>