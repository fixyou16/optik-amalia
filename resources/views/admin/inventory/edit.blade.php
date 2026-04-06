@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Edit Produk</h3>
    <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-3" style="max-width: 800px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.inventory.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT') <!-- Method Wajib untuk Update Data di Laravel -->

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="fw-bold form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold form-label">Kategori</label>
                            <input type="text" name="category" class="form-control" value="{{ $product->category }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold form-label">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                    </div>
                </div>

                <!-- Bagian Gambar -->
                <div class="col-md-4 text-center border-start">
                    <label class="fw-bold form-label d-block">Foto Produk Saat Ini</label>
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/200' }}" class="img-thumbnail mb-3" style="width: 100%; max-height: 250px; object-fit: cover;">
                    
                    <div class="text-start">
                        <label class="small fw-bold">Ganti Foto Baru</label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted d-block mt-1">*Abaikan jika tidak ingin ganti foto</small>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-success fw-bold px-4"><i class="bi bi-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection