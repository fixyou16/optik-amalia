<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Amalia Eyewear</title>
    
    <!-- Favicon Amalia -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Desain Halus & Modern */
        body { 
            background-color: #f8fafc; /* Abu-abu kebiruan sangat muda dan halus */
            font-family: 'Inter', sans-serif; /* Font modern */
            color: #334155;
            overflow-x: hidden; 
        }

        /* Sidebar Styling */
        .sidebar { 
            width: 260px; 
            background-color: #ffffff; 
            min-height: 100vh;
            box-shadow: 2px 0 24px rgba(0,0,0,0.03); /* Bayangan sangat lembut */
            position: fixed; /* Supaya sidebar diam saat konten di-scroll */
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        /* Menu Links */
        .sidebar-menu {
            padding: 0 15px;
            flex-grow: 1;
        }
        .sidebar-link { 
            color: #64748b; /* Warna teks abu-abu elegan */
            text-decoration: none; 
            padding: 12px 18px; 
            margin-bottom: 8px;
            display: flex; 
            align-items: center;
            font-size: 0.95rem; 
            font-weight: 500;
            border-radius: 12px; /* Sudut membulat halus */
            transition: all 0.3s ease; /* Animasi mulus */
        }
        
        .sidebar-link i {
            font-size: 1.25rem;
            margin-right: 14px;
            transition: all 0.3s ease;
        }

        /* Efek saat disentuh (Hover) */
        .sidebar-link:hover { 
            background-color: #fef2f2; /* Merah sangat muda */
            color: #e62424; 
        }

        /* Efek saat menu aktif */
        .sidebar-link.active { 
            background-color: #e62424; 
            color: #ffffff; 
            box-shadow: 0 4px 12px rgba(230, 36, 36, 0.25); /* Glow merah halus */
        }

        /* Konten Area */
        .content-area { 
            margin-left: 260px; /* Jarak untuk sidebar fixed */
            padding: 40px; 
            width: calc(100% - 260px);
        }

        /* Modifikasi Card Bawaan agar lebih membaur */
        .card {
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
            border: 1px solid #f1f5f9 !important;
        }

        /* Alert styling */
        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>
<body>

<div>
    <!-- Sidebar Kiri -->
    <div class="sidebar py-4">
        
        <!-- Logo Amalia -->
        <div class="text-center mb-5 px-3">
            <img src="{{ asset('images/logo.png') }}" style="max-width: 160px; height: auto;" alt="Amalia Eyewear">
            <div class="mt-2 text-muted" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 600;">
                Workspace Admin
            </div>
        </div>
        
        <!-- Menu Navigasi -->
        <div class="sidebar-menu">
            <a href="{{ route('admin.orders') }}" class="sidebar-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i> Pesanan Masuk
            </a>
            
            <a href="{{ route('admin.inventory') }}" class="sidebar-link {{ request()->routeIs('admin.inventory') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk / Inventaris
            </a>
            
            <div class="my-4 border-top border-light"></div> <!-- Garis pemisah halus -->
            
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-shop"></i> Lihat Toko
            </a>
        </div>
        
        <!-- Tombol Logout di paling bawah -->
        <div class="px-4 mt-auto mb-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-light w-100 fw-semibold text-danger border-0 shadow-sm" style="border-radius: 12px; padding: 10px;">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                </button>
            </form>
        </div>
    </div>

    <!-- Konten Kanan -->
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm bg-white text-success border-start border-success border-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>