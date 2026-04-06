@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Daftar Pesanan Pelanggan</h3>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3">Tanggal & ID</th>
                    <th>Detail Pelanggan</th>
                    <th>Lensa & Kurir</th>
                    <th>Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <!-- Kolom 1: ID & Waktu -->
                    <td class="ps-4">
                        <strong class="text-primary">#{{ $order->id }}</strong><br>
                        <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </td>
                    
                    <!-- Kolom 2: Nama & WA -->
                    <td>
                        <strong>{{ $order->customer_name }}</strong><br>
                        <a href="https://wa.me/{{ $order->customer_phone }}" target="_blank" class="text-success text-decoration-none small">
                            <i class="bi bi-whatsapp"></i> {{ $order->customer_phone }}
                        </a>
                    </td>

                    <!-- Kolom 3: Resep & Total -->
                    <td>
                        <span class="badge bg-secondary mb-1">Kurir: {{ $order->shipping_courier }}</span>
                        <!-- TAMBAHAN BADGE PEMBAYARAN -->
                        <span class="badge bg-dark mb-1">Bayar: {{ $order->payment_method }}</span>
                        <br>
                        <small class="text-muted">Resep: L({{ $order->minus_left ?? '-' }}) R({{ $order->minus_right ?? '-' }})</small><br>
                        <strong class="text-danger">Rp {{ number_format($order->total_price) }}</strong>
                    </td>

                
                   <!-- Kolom 4: Aksi Status & Resi -->
                    <td class="pe-4" style="min-width: 250px;">
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                            @csrf @method('PATCH')
                            
                            <!-- Input Nomor Resi -->
                            <div class="mb-2">
                                <input type="text" name="tracking_number" class="form-control form-control-sm text-center" placeholder="Input No. Resi (Opsional)" value="{{ $order->tracking_number }}">
                            </div>

                            <!-- Pilih Status -->
                            <div class="input-group input-group-sm">
                                <select name="status" class="form-select fw-bold @if($order->status == 'pending') text-danger @elseif($order->status == 'selesai') text-success @else text-primary @endif">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>1. Belum Bayar</option>
                                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>2. Dikemas</option>
                                    <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>3. Dikirim</option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>4. Selesai</option>
                                </select>
                                <button class="btn btn-dark" type="submit">Update</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada pesanan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection