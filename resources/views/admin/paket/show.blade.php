@extends('layouts.admin')

@section('title', 'Detail Paket')

@section('content')
<div class="card">
<div class="card-header">Detail Paket: {{ $paket->nama_paket }}</div>
<div class="card-body">
<p><strong>Deskripsi:</strong> {{ $paket->deskripsi }}</p>
<p><strong>Waktu Ujian:</strong> {{ $paket->waktu_ujian }} menit</p>
<p><strong>Status:</strong> {{ $paket->is_active ? 'Aktif' : 'Non-aktif' }}</p>
<a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Kembali</a>
</div>
</div>
@endsection