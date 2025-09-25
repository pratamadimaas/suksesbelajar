@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container">
<h1>Riwayat Ujian Anda</h1>
<p class="lead">Ini adalah daftar ujian yang sudah Anda ikuti.</p>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>#</th>
<th>Paket Ujian</th>
<th>Total Skor</th>
<th>Waktu Selesai</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@forelse ($riwayatUjian as $ujian)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $ujian->paket->nama_paket }}</td>
<td>{{ $ujian->total_skor }}</td>
<td>{{ $ujian->selesai_ujian ? $ujian->selesai_ujian->format('d/m/Y H:i') : '-' }}</td>
<td>
@if ($ujian->status === 'finished')
<a href="{{ route('ujian.hasil', $ujian) }}" class="btn btn-sm btn-success">Lihat Hasil</a>
@else
<a href="{{ route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => 1]) }}" class="btn btn-sm btn-warning">Lanjutkan Ujian</a>
@endif
</td>
</tr>
@empty
<tr>
<td colspan="5" class="text-center">Anda belum mengerjakan ujian.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
<hr>
<h3>Daftar Paket Ujian Tersedia</h3>
<div class="row mt-4">
@foreach ($pakets as $paket)
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
@endforeach
</div>
</div>
@endsection