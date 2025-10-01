@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%; border-radius: 1rem;">

        <!-- Header hijau -->
        <div class="card-header text-center" style="background-color: #059669; color: #ffffff; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <h4 class="mb-0 fw-bold">Registrasi Akun Baru</h4>
        </div>

        <!-- Body putih -->
        <div class="card-body p-4" style="background-color: #ffffff;">
            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold" style="color: #1f2937;">Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required autofocus
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold" style="color: #1f2937;">Nomor HP</label>
                    <input type="text" name="phone" id="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}"
                           placeholder="0812xxxxxxx"
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold" style="color: #1f2937;">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold" style="color: #1f2937;">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold" style="color: #1f2937;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control"
                           required
                           style="border-radius: 0.5rem; border: 1px solid #d1fae5;">
                </div>

                <!-- Tombol -->
                <div class="d-grid gap-2">
                    <button type="submit"
                            class="btn fw-semibold"
                            style="background-color: #059669; color: #ffffff; border-radius: 0.5rem; transition: 0.3s;">
                        Daftar
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer hijau tua -->
        <div class="card-footer text-center" style="background-color: #047857; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <p class="mb-0" style="color: #ffffff; font-size: 0.9rem;">
                Sudah punya akun? 
                <a href="{{ route('login.form') }}" style="color: #f97316; font-weight: 600; text-decoration: none;">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
