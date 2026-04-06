@extends('shop.layout')

@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-5">
        <div class="card border-0 shadow rounded-4 p-4">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill text-primary" style="font-size: 3rem;"></i>
                <h4 class="fw-bold mt-2">Daftar Akun Baru</h4>
                <p class="text-muted small">Bergabunglah untuk mulai berbelanja kacamata idaman Anda.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control bg-light border-start-0" placeholder="Masukkan nama Anda" required autofocus>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger small" />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-light border-start-0" placeholder="nama@email.com" required>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="Minimal 8 karakter" required>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold small">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-check-circle"></i></span>
                        <input type="password" name="password_confirmation" class="form-control bg-light border-start-0" placeholder="Ketik ulang password" required>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger small" />
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-pill shadow-sm">Daftar Sekarang</button>
                <div class="d-flex align-items-center my-4">
    <hr class="flex-grow-1 text-muted">
    <span class="mx-2 text-muted small">ATAU</span>
    <hr class="flex-grow-1 text-muted">
</div>

<a href="{{ route('google.login') }}" class="btn btn-outline-dark btn-lg w-100 fw-bold rounded-pill d-flex align-items-center justify-content-center gap-2">
    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
    Daftar dengan Google
</a>
                <!-- Link ke Login -->
                <div class="text-center mt-4">
                    <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Masuk di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styling agar input group terasa menyatu seperti form modern */
    .input-group-text { border-color: #dee2e6; color: #6c757d; }
    .form-control:focus { box-shadow: none; border-color: #dee2e6; }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control { border-color: #0d6efd; }
</style>
@endsection