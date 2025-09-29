@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')

<div class="container d-flex justify-content-center">
<div class="card" style="max-width: 500px; width: 100%;">
<div class="card-header text-center">
<h4>Registrasi Akun Baru</h4>
</div>
<div class="card-body">
<form method="POST" action="{{ route('register.process') }}">
@csrf
<div class="mb-3">
<label for="name" class="form-label">Nama</label>
<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
@error('name')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

{{-- NEW: Input Nomor HP --}}

<div class="mb-3">
<label for="phone" class="form-label">Nomor HP</label>
<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="">
@error('phone')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
{{-- END NEW --}}

<div class="mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
@error('email')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<div class="mb-3">
<label for="password" class="form-label">Password</label>
<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
@error('password')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<div class="mb-3">
<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
</div>
<!-- Tambahkan input opsional lainnya seperti 'phone' dan 'birth_date' -->
<div class="d-grid gap-2">
<button type="submit" class="btn btn-primary">Daftar</button>
</div>
</form>
</div>
<div class="card-footer text-center">
Sudah punya akun? <a href="{{ route('login.form') }}">Login di sini</a>
</div>
</div>
</div>
@endsection