@extends('shop.layout')

@section('content')
<div class="row">
    <!-- Sidebar Profil -->
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm text-center py-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0d6efd&color=fff" class="rounded-circle mx-auto mb-3" width="80">
            <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
            <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-75 rounded-pill">Keluar</button>
            </form>
        </div>
    </div>

    <!-- Area Pesanan (Tabs) -->
    <div class="col-md-9">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white p-0 border-bottom">
                <ul class="nav nav-tabs nav-fill border-0" id="orderTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold py-3 text-dark border-0" data-bs-toggle="tab" data-bs-target="#tab-pending">Belum Bayar</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold py-3 text-dark border-0" data-bs-toggle="tab" data-bs-target="#tab-proses">Dikemas</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold py-3 text-dark border-0" data-bs-toggle="tab" data-bs-target="#tab-dikirim">Dikirim</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold py-3 text-dark border-0" data-bs-toggle="tab" data-bs-target="#tab-selesai">Selesai</button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-4 tab-content">
                <!-- Helper Fungsi untuk Tampilan Item -->
                @php
                    function renderOrderList($orders_filtered, $empty_msg) {
                        if($orders_filtered->isEmpty()) {
                            echo '<div class="text-center py-5 text-muted"><i class="bi bi-box-seam fs-1 d-block mb-2 opacity-50"></i>'.$empty_msg.'</div>';
                        } else {
                            foreach($orders_filtered as $order) {
                                
                                // Logika Warna Timeline Tracking
                                $step1 = $step2 = $step3 = $step4 = "text-muted";
                                $bar1 = $bar2 = $bar3 = "bg-secondary opacity-25";
                                
                                if($order->status == 'pending') { 
                                    $step1 = "text-danger fw-bold"; 
                                } elseif($order->status == 'diproses') { 
                                    $step1 = $step2 = "text-primary fw-bold"; $bar1 = "bg-primary"; 
                                } elseif($order->status == 'dikirim') { 
                                    $step1 = $step2 = $step3 = "text-primary fw-bold"; $bar1 = $bar2 = "bg-primary"; 
                                } elseif($order->status == 'selesai') { 
                                    $step1 = $step2 = $step3 = $step4 = "text-success fw-bold"; $bar1 = $bar2 = $bar3 = "bg-success"; 
                                }

                                echo '
                                <div class="card border-0 shadow-sm mb-4 border-top border-3 border-danger">
                                    <div class="card-body p-4">
                                        <!-- Header Pesanan -->
                                        <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                                            <div>
                                                <span class="text-muted small">Tgl Pesan: '.$order->created_at->format('d M Y, H:i').'</span><br>
                                                <strong class="text-dark">INV-'.str_pad($order->id, 5, '0', STR_PAD_LEFT).'</strong>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 text-uppercase">'.$order->status.'</span>
                                            </div>
                                        </div>

                                        <!-- FITUR TRACKING TIMELINE -->
                                        <div class="position-relative m-4">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar '.$bar1.'" role="progressbar" style="width: 33%"></div>
                                                <div class="progress-bar '.$bar2.'" role="progressbar" style="width: 33%"></div>
                                                <div class="progress-bar '.$bar3.'" role="progressbar" style="width: 34%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between position-absolute w-100" style="top: -12px;">
                                                <div class="text-center bg-white px-2 '.$step1.'"><i class="bi bi-wallet2 fs-5"></i><br><small style="font-size:11px;">Belum Bayar</small></div>
                                                <div class="text-center bg-white px-2 '.$step2.'"><i class="bi bi-box-seam fs-5"></i><br><small style="font-size:11px;">Dikemas</small></div>
                                                <div class="text-center bg-white px-2 '.$step3.'"><i class="bi bi-truck fs-5"></i><br><small style="font-size:11px;">Dikirim</small></div>
                                                <div class="text-center bg-white px-2 '.$step4.'"><i class="bi bi-check-circle fs-5"></i><br><small style="font-size:11px;">Selesai</small></div>
                                            </div>
                                        </div>

                                        <!-- Informasi Resi & Total -->
                                        <div class="bg-light p-3 rounded mt-5 d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted d-block">Kurir Pengiriman:</small>
                                                <strong class="text-dark">'.$order->shipping_courier.'</strong>
                                                
                                                <!-- Jika ada nomor resi, tampilkan -->
                                                '.($order->tracking_number ? '<br><small class="text-muted">No. Resi:</small> <span class="badge bg-dark">'.$order->tracking_number.'</span>' : '').'
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">Total Belanja</small>
                                                <h4 class="text-danger fw-bold mb-0">Rp '.number_format($order->total_price).'</h4>
                                            </div>
                                        </div>
                                        
                                        <!-- Tombol Bayar jika status pending -->
                                        '.($order->status == 'pending' ? '
                                        <div class="text-end mt-3">
                                            <a href="'.route('payment.instruction', $order->id).'" class="btn btn-danger fw-bold px-4 rounded-pill">Bayar Sekarang</a>
                                        </div>' : '').'

                                    </div>
                                </div>';
                            }
                        }
                    }
                @endphp

                <!-- Isi Tiap Tab -->
                <div class="tab-pane fade show active" id="tab-pending">
                    @php renderOrderList($orders->where('status', 'pending'), 'Tidak ada pesanan yang belum dibayar.'); @endphp
                </div>
                <div class="tab-pane fade" id="tab-proses">
                    @php renderOrderList($orders->where('status', 'diproses'), 'Tidak ada pesanan yang sedang dikemas.'); @endphp
                </div>
                <div class="tab-pane fade" id="tab-dikirim">
                    @php renderOrderList($orders->where('status', 'dikirim'), 'Tidak ada pesanan yang sedang dikirim.'); @endphp
                </div>
                <div class="tab-pane fade" id="tab-selesai">
                    @php renderOrderList($orders->where('status', 'selesai'), 'Belum ada pesanan yang selesai.'); @endphp
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling khusus agar tab aktif seperti garis bawah di Shopee */
    .nav-tabs .nav-link.active {
        border-bottom: 3px solid #0d6efd !important;
        color: #0d6efd !important;
        background: transparent;
    }
</style>
@endsection