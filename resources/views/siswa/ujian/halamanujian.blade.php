@extends('layouts.app')

@section('title', 'Mulai Ujian')

@section('content')
<div class="container">
<div class="card">
<div class="card-header">Detail Ujian</div>
<div class="card-body">
<h3>{{ $paket->nama_paket }}</h3>
<p><strong>Deskripsi:</strong> {{ $paket->deskripsi }}</p>
<p><strong>Jumlah Soal:</strong> {{ $paket->getTotalSoal() }}</p>
<p><strong>Waktu Pengerjaan:</strong> {{ $paket->waktu_ujian }} menit</p>
</div>
<div class="card-footer">
<form action="{{ route('ujian.start', $paket) }}" method="POST">
@csrf
<button type="submit" class="btn btn-success btn-lg">Mulai Ujian</button>
</form>
</div>
</div>
</div>
@endsection