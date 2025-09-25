@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container text-center">
<h1>Selamat Datang di Akademi CPNS</h1>
<p class="lead">Pilih paket ujian yang ingin Anda kerjakan.</p>
<div class="row mt-4">
@forelse ($pakets as $paket)
<div class="col-md-4 mb-4">
<div class="card h-100">
<div class="card-body">
<h5 class="card-title">{{ $paket->nama_paket }}</h5>
<p class="card-text">{{ $paket->deskripsi }}</p>
<p class="card-text">Total Soal: {{ $paket->getTotalSoal() }}</p>
<p class="card-text">Waktu: {{ $paket->waktu_ujian }} menit</p>
</div>
<div class="card-footer">
<a href="{{ route('ujian.show', $paket) }}" class="btn btn-primary">Kerjakan Ujian</a>
</div>
</div>
</div>
@empty
<div class="col-12">
<div class="alert alert-info">Belum ada paket ujian yang tersedia.</div>
</div>
@endforelse
</div>
</div>
@endsection