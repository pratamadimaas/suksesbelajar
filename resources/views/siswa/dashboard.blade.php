@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')

<style>
.paket-card {
background-color: #ffffff;
border-radius: 1.5rem;
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
padding: 2.5rem;
transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
cursor: pointer;
display: flex;
flex-direction: column;
height: 100%;
}
.paket-card:hover {
transform: translateY(-5px);
box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}
.paket-title {
color: #1a202c;
font-weight: 700;
margin-bottom: 0.5rem;
}
.paket-desc {
color: #4a5568;
font-size: 0.9rem;
margin-bottom: 1.5rem;
flex-grow: 1;
}
.paket-details {
font-size: 0.8rem;
color: #718096;
}
.btn-start-ujian {
background-color: #4c51bf;
border: none;
color: white;
font-weight: 600;
border-radius: 9999px;
padding: 0.75rem 2rem;
width: 100%;
margin-top: 1.5rem;
transition: background-color 0.3s ease;
}
.btn-start-ujian:hover {
background-color: #667eea;
}
.alert-info {
background-color: #e0f7fa;
color: #00796b;
border-left: 5px solid #00acc1;
}
</style>

@endpush

@section('content')

<div class="container">
<h1>Riwayat Ujian Anda</h1>
<p class="lead">Ini adalah daftar ujian yang sudah Anda ikuti.</p>
<div class="mb-3">
<a href="{{ route('siswa.profile') }}" class="btn btn-primary">Ubah Password</a>
</div>
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
