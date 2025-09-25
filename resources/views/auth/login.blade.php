@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center">
<div class="card" style="max-width: 500px; width: 100%;">
<div class="card-header text-center">
<h4>Login</h4>
</div>
<div class="card-body">
<form method="POST" action="{{ route('login.process') }}">
@csrf
<div class="mb-3">
<label for="email" class="form-label">Alamat Email</label>
<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
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
<div class="d-grid gap-2">
<button type="submit" class="btn btn-primary">Login</button>
</div>
</form>
</div>
<div class="card-footer text-center">
</div>
</div>
</div>
@endsection