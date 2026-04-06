@extends('shop.layout')

@section('content')
<!-- ADD THIS ERROR DISPLAY BLOCK -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<h4 class="fw-bold mb-4">Keranjang & Checkout</h4>
<div class="row">
    <!-- Kolom Kiri: Keranjang -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @php $total = 0; @endphp
                @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                        @php 
                            $total += $details['price'] * $details['quantity']; 
                            // Ambil data produk asli dari DB untuk cek stok realtime
                            $product_db = \App\Models\Product::find($id);
                            $stok_asli = $product_db ? $product_db->stock : 0;
                        @endphp
                        
                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                            <img src="{{ $details['image'] ? asset('storage/'.$details['image']) : 'https://placehold.co/100' }}" width="80" class="rounded shadow-sm" style="object-fit: cover; height: 80px;">
                            
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1">{{ $details['name'] }}</h6>
                                </div>
                                
                                <h6 class="text-primary fw-bold mt-1 mb-1">Rp {{ number_format($details['price']) }}</h6>
                                
                                <!-- Tampilkan Info Sisa Stok -->
                                <small class="text-muted d-block mb-2">Sisa stok: <strong class="{{ $stok_asli < 5 ? 'text-danger' : '' }}">{{ $stok_asli }} pcs</strong></small>
                                
                                <!-- Kontrol Kuantitas (+/-) -->
                                <div class="d-flex align-items-center">
                                    <div class="input-group input-group-sm" style="width: 120px;">
                                        
                                        <!-- Jika qty = 1, tombol minus menjadi tombol hapus (merah) -->
                                        @if($details['quantity'] <= 1)
                                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-outline-danger fw-bold" onclick="return confirm('Hapus produk ini dari keranjang?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('cart.decrease', $id) }}" class="btn btn-outline-secondary fw-bold">-</a>
                                        @endif
                                        
                                        <input type="text" class="form-control text-center fw-bold bg-white" value="{{ $details['quantity'] }}" readonly>
                                        
                                        <!-- Jika qty sudah sama dengan stok, matikan (disable) tombol plus -->
                                        @if($details['quantity'] >= $stok_asli)
                                            <button class="btn btn-outline-secondary fw-bold disabled" aria-disabled="true">+</button>
                                        @else
                                            <a href="{{ route('cart.increase', $id) }}" class="btn btn-outline-secondary fw-bold">+</a>
                                        @endif
                                        
                                    </div>
                                    <span class="ms-3 text-muted small fw-bold">Sub: Rp {{ number_format($details['price'] * $details['quantity']) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                        <p class="mt-2 text-muted">Keranjang masih kosong</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Checkout -->
    @if(session('cart'))
    <div class="col-md-5">
        <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
            <div class="card-body bg-light rounded">
                <h5 class="fw-bold border-bottom pb-2">Ringkasan Pesanan</h5>
                
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <!-- Form Data Diri -->
                    <div class="mb-2 mt-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Nama Penerima" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="customer_phone" class="form-control" placeholder="No. WhatsApp" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="customer_address" class="form-control" placeholder="Alamat Lengkap Pengiriman" rows="3" required></textarea>
                    </div>
                    
                    <!-- Resep Lensa -->
                    <p class="small text-muted mb-1 mt-3">Resep Lensa (Jika ada):</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Kiri</span>
                        <input type="text" name="minus_left" class="form-control" placeholder="cth: -1.00">
                        <span class="input-group-text">Kanan</span>
                        <input type="text" name="minus_right" class="form-control" placeholder="cth: -1.50">
                    </div>

                    <!-- Pilih Pengiriman (Yang sudah ada) -->
                    <h6 class="fw-bold mt-4 mb-2">Pilih Pengiriman</h6>
                    <select name="shipping_courier" id="shipping" class="form-select mb-3 bg-light" required onchange="calculateTotal()">
                        <option value="" disabled selected>-- Pilih Kurir --</option>
                        <option value="JNE" data-cost="15000">JNE Reguler (Rp 15.000)</option>
                        <option value="JNT" data-cost="18000">J&T Express (Rp 18.000)</option>
                        <option value="SICEPAT" data-cost="20000">SiCepat HALU (Rp 20.000)</option>
                    </select>

                    <!-- TAMBAHAN: Pilih Metode Pembayaran -->
                    <h6 class="fw-bold mt-3 mb-2">Metode Pembayaran</h6>
                    <select name="payment_method" class="form-select mb-3 bg-light border-danger" required>
                        <option value="" disabled selected>-- Pilih Cara Bayar --</option>
                        <optgroup label="Bayar di Tempat">
                            <option value="COD">CASH ON DELIVERY (COD)</option>
                        </optgroup>
                        <optgroup label="Transfer Bank (Verifikasi Manual)">
                            <option value="BCA">Bank BCA</option>
                            <option value="MANDIRI">Bank Mandiri</option>
                            <option value="BRI">Bank BRI</option>
                        </optgroup>
                        <optgroup label="E-Wallet">
                            <option value="QRIS">QRIS (Gopay/OVO/Dana/Spay)</option>
                        </optgroup>
                    </select>

                    <!-- Hitung Total -->
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Subtotal Produk</span>
                        <span class="fw-bold">Rp <span id="subtotal_text">{{ number_format($total) }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Ongkos Kirim</span>
                        <span class="fw-bold text-success">+ Rp <span id="shipping_text">0</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Total Pembayaran</h5>
                        <h5 class="fw-bold text-primary">Rp <span id="grand_total_text">{{ number_format($total) }}</span></h5>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4 rounded-pill fw-bold py-2">Buat Pesanan</button>
                </form>

                <!-- Hidden Input for JS Calculation -->
                <input type="hidden" id="subtotal_val" value="{{ $total }}">
            </div>
        </div>
    </div>
    @endif
</div>

<!-- JS Untuk Hitung Total Otomatis -->
<script>
    function calculateTotal() {
        let subtotal = parseInt(document.getElementById('subtotal_val').value);
        let shippingSelect = document.getElementById('shipping');
        let shippingCost = parseInt(shippingSelect.options[shippingSelect.selectedIndex].getAttribute('data-cost')) || 0;
        
        let grandTotal = subtotal + shippingCost;

        // Update Text
        document.getElementById('shipping_text').innerText = shippingCost.toLocaleString('id-ID');
        document.getElementById('grand_total_text').innerText = grandTotal.toLocaleString('id-ID');
    }
</script>
@endsection