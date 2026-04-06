@extends('admin.layout')

@section('content')
<h3 class="fw-bold mb-4">Manajemen Produk</h3>

<div class="row">
    <!-- Form Tambah Produk -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
            <div class="card-header bg-dark text-white fw-bold">
                <i class="bi bi-plus-circle me-1"></i> Tambah Produk
            </div>
            <div class="card-body bg-white">
                <!-- PENTING: Tambahkan enctype untuk upload gambar -->
                <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label class="small fw-bold">Nama Produk</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="small fw-bold">Kategori</label>
                        <input type="text" name="category" class="form-control form-control-sm" placeholder="cth: Frame Pria" required>
                    </div>
                    <div class="row mb-2 g-2">
                        <div class="col-6">
                            <label class="small fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-6">
                            <label class="small fw-bold">Stok</label>
                            <input type="number" name="stock" class="form-control form-control-sm" value="10" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="small fw-bold">Foto Produk (Opsional)</label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Deskripsi</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Produk</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Produk -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">Foto</th>
                            <th>Info Produk</th>
                            <th>Harga & Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $p)
                        <tr>
                            <td class="ps-3">
                                <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://placehold.co/100' }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong class="d-block">{{ $p->name }}</strong>
                                <span class="badge bg-secondary">{{ $p->category }}</span>
                            </td>
                            <td>
                                <span class="text-success fw-bold d-block">Rp {{ number_format($p->price) }}</span>
                                <small class="text-muted">Stok: {{ $p->stock }} pcs</small>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.inventory.edit', $p->id) }}" class="btn btn-sm btn-warning mb-1 w-100"><i class="bi bi-pencil-square"></i> Edit</a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.inventory.destroy', $p->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger w-100" onclick="return confirm('Yakin hapus produk ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada produk di etalase.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection