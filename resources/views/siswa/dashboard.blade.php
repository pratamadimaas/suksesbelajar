@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')
<style>
/* General */
body {
    background-color: #f9fafb; /* Light Gray */
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #059669, #047857);
    color: #fff;
    border-radius: 1.5rem;
    padding: 2.5rem;
    margin-bottom: 2rem;
}
.hero-section h1 {
    font-weight: 700;
}
.hero-section p {
    font-size: 1.1rem;
    color: #d1fae5;
}

/* Stat Cards */
.stat-card {
    background-color: #fff;
    border-radius: 1rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    padding: 1.5rem;
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
}
.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #059669; /* Primary */
}
.stat-label {
    font-size: 0.9rem;
    color: #6b7280; /* Gray */
}

/* Riwayat Ujian Timeline */
.timeline {
    border-left: 3px solid #d1fae5;
    padding-left: 1.5rem;
}
.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}
.timeline-item::before {
    content: '';
    position: absolute;
    left: -1.15rem;
    top: 0.4rem;
    width: 0.75rem;
    height: 0.75rem;
    background-color: #059669;
    border-radius: 50%;
}
.timeline-item h5 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}
.timeline-item small {
    color: #6b7280;
}

/* Paket Cards */
.paket-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    padding: 1.5rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.2s ease;
}
.paket-card:hover {
    transform: translateY(-3px);
}
.paket-title {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.paket-desc {
    color: #6b7280;
    font-size: 0.9rem;
    flex-grow: 1;
}
.btn-primary {
    background-color: #059669;
    border: none;
}
.btn-primary:hover {
    background-color: #047857;
}
.btn-orange {
    background-color: #f97316;
    color: #fff;
    border-radius: 9999px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
}
.btn-orange:hover {
    background-color: #ea580c;
}
</style>
@endpush

@section('content')
<div class="container">

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Selamat Datang, {{ Auth::user()->name }} 👋</h1>
        <p>Terus tingkatkan kemampuanmu dengan latihan soal yang tersedia. Semangat meraih sukses!</p>
    </div>

    <!-- Stat Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value">{{ $riwayatUjian->count() }}</div>
                <div class="stat-label">Ujian Dikerjakan</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value">
                    {{ $riwayatUjian->avg('total_skor') ? number_format($riwayatUjian->avg('total_skor'), 1) : '-' }}
                </div>
                <div class="stat-label">Skor Rata-rata</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-value">{{ $pakets->count() }}</div>
                <div class="stat-label">Paket Ujian Tersedia</div>
            </div>
        </div>
    </div>

    <!-- Riwayat Ujian Timeline -->
    <h3 class="mb-3">📜 Riwayat Ujian</h3>
    <div class="timeline mb-5">
        @forelse ($riwayatUjian as $ujian)
        <div class="timeline-item">
            <h5>{{ $ujian->paket->nama_paket }}</h5>
            <small>
                Skor: <strong>{{ $ujian->total_skor }}</strong> | 
                {{ $ujian->selesai_ujian ? $ujian->selesai_ujian->format('d/m/Y H:i') : 'Belum selesai' }}
            </small>
            <div class="mt-2">
                @if ($ujian->status === 'finished')
                <a href="{{ route('ujian.hasil', $ujian) }}" class="btn btn-sm btn-primary">Lihat Hasil</a>
                @else
                <a href="{{ route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => 1]) }}" class="btn btn-sm btn-orange">Lanjutkan</a>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray">Belum ada riwayat ujian.</p>
        @endforelse
    </div>

    <!-- Paket Ujian -->
    <h3 class="mb-3">📦 Paket Ujian Tersedia</h3>
    <div class="row">
        @foreach ($pakets as $paket)
        <div class="col-md-4 mb-4">
            <div class="paket-card">
                <div>
                    <h5 class="paket-title">{{ $paket->nama_paket }}</h5>
                    <p class="paket-desc">{{ $paket->deskripsi }}</p>
                    <p class="text-gray">Total Soal: {{ $paket->getTotalSoal() }} | {{ $paket->waktu_ujian }} menit</p>
                </div>
                <a href="{{ route('ujian.show', $paket) }}" class="btn btn-primary mt-3">Kerjakan</a>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
