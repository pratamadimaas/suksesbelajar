@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div class="row">
<div class="col-lg-8 mx-auto">
<div class="card shadow-sm">
<div class="card-header bg-primary text-white">
<h5 class="mb-0">Profil Pengguna</h5>
</div>
<div class="card-body">
<div class="mb-4">
<p class="h5">Nama: {{ Auth::user()->name }}</p>
<p class="h5">Email: {{ Auth::user()->email }}</p>
</div>
<hr>

            <h5 class="mb-3">Ganti Password</h5>
            <form action="{{ route('siswa.updatePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
