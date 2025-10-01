@extends('layouts.app')

@section('title', 'Hasil Ujian')

@push('styles')
<style>
body {
    background-color: #f9fafb; /* Light Gray */
}

/* Hero Section */
.hero-result {
    background: linear-gradient(135deg, #059669, #047857);
    color: #fff;
    border-radius: 1.5rem;
    padding: 3rem 2rem;
    text-align: center;
    margin-bottom: 2rem;
}
.hero-result h1 {
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.hero-result p {
    font-size: 1.1rem;
    color: #d1fae5;
}
.hero-score {
    font-size: 3rem;
    font-weight: 800;
    color: #f97316; /* Accent */
    margin-top: 1rem;
}

/* Stat Grid */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}
.stat-box {
    background: #ffffff;
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    border: 1px solid #e5e7eb;
    transition: transform 0.2s ease;
}
.stat-box:hover {
    transform: translateY(-3px);
}
.stat-box h5 {
    color: #6b7280; /* Gray */
    font-weight: 600;
    margin-bottom: 0.5rem;
}
.stat-box p {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

/* Ranking */
.ranking-box {
    background-color: #fff;
    border: 2px dashed #f97316; /* Accent */
    border-radius: 1rem;
    padding: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}
.ranking-box h5 {
    color: #1f2937; /* Dark */
    font-weight: 600;
}
.ranking-box p {
    font-size: 2rem;
    font-weight: 700;
    color: #f97316;
}

/* Buttons */
.button-group {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 3rem;
}
.btn-primary {
    background-color: #059669;
    border: none;
}
.btn-primary:hover {
    background-color: #047857;
}
.btn-secondary {
    background-color: #6b7280;
    border: none;
}
.btn-secondary:hover {
    background-color: #4b5563;
}

/* Question Section */
.question-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.question-card h6 {
    font-weight: 700;
    color: #1f2937;
}
.correct-answer {
    font-weight: bold;
    color: #059669;
}
.wrong-answer {
    font-weight: bold;
    color: #dc2626;
}
</style>
@endpush

@section('content')
<div class="container py-5">

    <!-- Hero Result -->
    <div class="hero-result shadow">
        <h1>Selamat 🎉</h1>
        <p>Anda telah menyelesaikan <strong>{{ $ujian->paket->nama_paket }}</strong></p>
        <div class="hero-score">{{ $ujian->total_skor }}</div>
        <small>{{ $ujian->mulai_ujian->format('d/m/Y') }} • Durasi: {{ $ujian->getDurasiUjian() }} menit</small>
    </div>

    <!-- Stat Grid -->
    <div class="stat-grid">
        <div class="stat-box">
            <h5>Skor TWK</h5>
            <p class="text-dark">{{ $ujian->skor_twk }}</p>
        </div>
        <div class="stat-box">
            <h5>Skor TIU</h5>
            <p class="text-dark">{{ $ujian->skor_tiu }}</p>
        </div>
        <div class="stat-box">
            <h5>Skor TKP</h5>
            <p class="text-dark">{{ $ujian->skor_tkp }}</p>
        </div>
    </div>

    <!-- Ranking -->
    <div class="ranking-box shadow-sm">
        <h5>Peringkat Anda</h5>
        <p>#{{ $ranking }}</p>
    </div>

    <!-- Buttons -->
    <div class="button-group">
        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary btn-lg">Kembali ke Dashboard</a>
        <a href="{{ route('ujian.leaderboard', ['paket_id' => $ujian->paket->id]) }}" class="btn btn-primary btn-lg">Lihat Leaderboard</a>
    </div>

    <!-- Pembahasan -->
    <h3 class="fw-bold mb-4">📘 Pembahasan Jawaban</h3>
    @foreach($ujian->ujianJawabans as $index => $jawaban)
        @php
            $soal = $jawaban->soal;
            $isCorrect = $jawaban->jawaban === $soal->kunci_jawaban;
        @endphp
        <div class="question-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6>Soal ke-{{ $index + 1 }} ({{ $soal->kategori }})</h6>
                <span class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }}">
                    {{ $isCorrect ? 'Benar' : 'Salah' }}
                </span>
            </div>
            <p>{!! $soal->pertanyaan !!}</p>
            <p>Jawaban Anda:
                <span class="{{ $isCorrect ? 'correct-answer' : 'wrong-answer' }}">
                    {{ $jawaban->jawaban }}
                </span>
            </p>
            <p>Kunci Jawaban: <span class="correct-answer">{{ $soal->kunci_jawaban }}</span></p>
            <div class="mt-3">
                <h6 class="text-success">Pembahasan:</h6>
                <p>{!! $soal->pembahasan !!}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
