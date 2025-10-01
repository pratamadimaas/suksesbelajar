@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="max-width: 480px; width: 100%; border-radius: 1rem;">
        <div class="card-header text-center" style="background-color: #059669; color: #ffffff; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <h4 class="mb-0 fw-bold">Masuk ke Akun</h4>
        </div>
        <div class="card-body p-4" style="background-color: #ffffff;">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold" style="color: #1f2937;">Alamat Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold" style="color: #1f2937;">Kata Sandi</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           required 
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" 
                            class="btn fw-semibold" 
                            style="background-color: #059669; color: #ffffff; border-radius: 0.5rem; transition: 0.3s;">
                        Login
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center" style="background-color: #f9fafb; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <p class="mb-0" style="color: #6b7280; font-size: 0.9rem;">
                Belum punya akun? 
                <a href="{{ route('register.form') }}" style="color: #f97316; font-weight: 600; text-decoration: none;">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
