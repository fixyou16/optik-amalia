@extends('shop.layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow rounded-4 p-4">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
                <h4 class="fw-bold mt-2">Masuk ke Akun Anda</h4>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-light" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg bg-light" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-pill">Masuk</button>
                <div class="d-flex align-items-center my-4">
    <hr class="flex-grow-1 text-muted">
    <span class="mx-2 text-muted small">ATAU</span>
    <hr class="flex-grow-1 text-muted">
</div>

<a href="{{ route('google.login') }}" class="btn btn-outline-dark btn-lg w-100 fw-bold rounded-pill d-flex align-items-center justify-content-center gap-2">
    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
    Masuk dengan Google
</a>
                <div class="text-center mt-4">
                    <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection