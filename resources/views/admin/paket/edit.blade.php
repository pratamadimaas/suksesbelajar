@extends('layouts.admin')

@section('title', 'Edit Paket Ujian')

@section('content')
<div class="card">
<div class="card-header">Form Edit Paket</div>
<div class="card-body">
<form action="{{ route('admin.paket.update', $paket) }}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
<label for="nama_paket" class="form-label">Nama Paket</label>
<input type="text" name="nama_paket" id="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror" value="{{ old('nama_paket', $paket->nama_paket) }}">
@error('nama_paket')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<!-- Tambahkan input lainnya seperti 'deskripsi', 'jumlah_soal_twk', dll. -->
<button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
</div>
@endsection