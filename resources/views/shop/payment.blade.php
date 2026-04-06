@extends('shop.layout')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-danger text-white text-center py-3">
                <h5 class="mb-0 fw-bold">Menunggu Pembayaran</h5>
            </div>
            
            <div class="card-body p-4 text-center">
                <p class="text-muted mb-1">Total yang harus dibayar:</p>
                <h2 class="fw-bold text-danger mb-4">Rp {{ number_format($order->total_price) }}</h2>

                <!-- Logika Menampilkan Rekening -->
                <!-- Logika Menampilkan Rekening -->
                @if($order->payment_method == 'COD')
                    <div class="alert alert-warning border-0 shadow-sm">
                        <i class="bi bi-cash-coin fs-1 text-warning mb-2 d-block"></i>
                        <h5 class="fw-bold">Bayar di Tempat (COD)</h5>
                        <p class="mb-0 small">Siapkan uang tunai sebesar <strong>Rp {{ number_format($order->total_price) }}</strong> saat kurir tiba di alamat Anda.</p>
                    </div>
                @elseif($order->payment_method == 'BCA')
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" width="100" class="mb-3">
                    <div class="bg-light p-3 rounded mb-3 border text-center">
                        <p class="mb-1 text-muted small">Kode Bank: <strong>014</strong></p>
                        <h4 class="fw-bold text-dark mb-0">000000000</h4>
                        <p class="mb-0 mt-1 fw-bold text-danger">a.n Amalia Eyewear</p>
                    </div>
                @elseif($order->payment_method == 'MANDIRI')
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_of_Bank_Mandiri.svg" width="100" class="mb-3">
                    <div class="bg-light p-3 rounded mb-3 border text-center">
                        <p class="mb-1 text-muted small">Kode Bank: <strong>008</strong></p>
                        <h4 class="fw-bold text-dark mb-0">000000000</h4>
                        <p class="mb-0 mt-1 fw-bold text-danger">a.n Amalia Eyewear</p>
                    </div>
                @elseif($order->payment_method == 'BRI')
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/BRI_2020.svg" width="100" class="mb-3">
                    <div class="bg-light p-3 rounded mb-3 border text-center">
                        <p class="mb-1 text-muted small">Kode Bank: <strong>002</strong></p>
                        <h4 class="fw-bold text-dark mb-0">000000000</h4>
                        <p class="mb-0 mt-1 fw-bold text-danger">a.n Amalia Eyewear</p>
                    </div>
                @elseif($order->payment_method == 'QRIS')
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" width="120" class="mb-3">
                    <div class="bg-light p-3 rounded mb-3 border">
                        <p class="mb-1 text-muted small">Scan QR Code ini menggunakan Gopay, OVO, Dana, M-BCA, dll:</p>
                        <!-- Gambar Dummy QRIS -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PembayaranOptikAmalia" class="img-fluid rounded mt-2">
                    </div>
                @endif

                <hr class="text-muted my-4">

                <div class="text-center">
                    <p class="small text-muted mb-2">Sudah melakukan pembayaran?</p>
                    
                    @php
                        $wa_admin = "628123456789"; // GANTI DENGAN WA ADMIN ANDA
                        $pesan = "Halo Admin Optik Amalia, saya ingin konfirmasi pembayaran untuk pesanan: %0A*ID Pesanan:* INV-".str_pad($order->id, 5, '0', STR_PAD_LEFT)."%0A*Atas Nama:* ".$order->customer_name."%0A*Total:* Rp ".number_format($order->total_price)."%0A%0ABerikut saya lampirkan bukti transfernya.";
                    @endphp

                    @if($order->payment_method != 'COD')
                        <a href="https://wa.me/{{ $wa_admin }}?text={{ $pesan }}" target="_blank" class="btn btn-success btn-lg w-100 rounded-pill fw-bold mb-2 shadow-sm">
                            <i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp
                        </a>
                    @endif
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100 rounded-pill">Lihat Daftar Pesanan Saya</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection