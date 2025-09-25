@extends('layouts.app')

@section('title', 'Hasil Ujian')

@push('styles')
<style>
    body {
        background-color: #f0f2f5;
    }
    .result-card {
        background-color: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        transition: transform 0.3s ease-in-out;
    }
    .result-card:hover {
        transform: translateY(-5px);
    }
    .header-card {
        border-radius: 1.25rem 1.25rem 0 0;
        background: linear-gradient(45deg, #007bff, #4c51bf);
        color: white;
        padding: 2rem;
        text-align: center;
        margin-bottom: -1.5rem;
        position: relative;
        z-index: 1;
    }
    .score-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        text-align: center;
        margin-top: 2rem;
    }
    .score-box {
        background-color: #f8f9fa;
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid #e9ecef;
    }
    .score-box h5 {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .score-box p {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }
    .ranking-box {
        background-color: #e3f2fd;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        border: 2px dashed #4c51bf;
    }
    .ranking-box h5 {
        color: #4c51bf;
        font-weight: 600;
    }
    .ranking-box p {
        font-size: 3rem;
        font-weight: 700;
        color: #4c51bf;
        margin: 0.5rem 0;
    }
    .button-group {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
    }
    .question-card {
        background-color: #fefefe;
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .correct-answer {
        font-weight: bold;
        color: #28a745;
    }
    .wrong-answer {
        font-weight: bold;
        color: #dc3545;
    }
</style>
@endpush

@section('content')

<div class="container py-5">
    <div class="header-card shadow">
        <h1 class="my-0 display-4 fw-bold">Selamat!</h1>
        <p class="lead mt-2">Anda telah menyelesaikan Ujian {{ $ujian->paket->nama_paket }}</p>
    </div>
    <div class="result-card shadow-lg">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Rangkuman Ujian</h4>
                <p class="text-muted mb-0"><i class="bi bi-clock-fill me-1"></i>Durasi: {{ $ujian->getDurasiUjian() }} menit</p>
            </div>
            <p class="h5 fw-bold text-muted mb-0">{{ $ujian->mulai_ujian->format('d/m/Y') }}</p>
        </div>

        <hr class="mb-4">

        <div class="score-summary">
            <div class="score-box">
                <h5>Skor TWK</h5>
                <p class="text-info">{{ $ujian->skor_twk }}</p>
            </div>
            <div class="score-box">
                <h5>Skor TIU</h5>
                <p class="text-warning">{{ $ujian->skor_tiu }}</p>
            </div>
            <div class="score-box">
                <h5>Skor TKP</h5>
                <p class="text-success">{{ $ujian->skor_tkp }}</p>
            </div>
        </div>

        <hr class="mt-4 mb-4">

        <div class="ranking-box">
            <h5>Total Skor Anda</h5>
            <p>{{ $ujian->total_skor }}</p>
            <p class="lead fw-bold mb-0">
                Peringkat Anda: <span class="text-primary">{{ $ranking }}</span>
            </p>
        </div>

        <div class="button-group">
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary btn-lg">Kembali ke Dashboard</a>
            <a href="{{ route('ujian.leaderboard', ['paket_id' => $ujian->paket->id]) }}" class="btn btn-primary btn-lg">Lihat Leaderboard</a>
        </div>
    </div>

    <div class="mt-5">
        <h3 class="fw-bold text-center mb-4">Pembahasan Jawaban</h3>
        @foreach($ujian->ujianJawabans as $index => $jawaban)
            @php
                $soal = $jawaban->soal;
                $isCorrect = $jawaban->jawaban_siswa === $soal->kunci_jawaban;
            @endphp
            <div class="question-card">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="fw-bold">Soal ke-{{ $index + 1 }} - Kategori: {{ $soal->kategori }}</p>
                    <span class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }}">
                        {{ $isCorrect ? 'Benar' : 'Salah' }}
                    </span>
                </div>
                <p>{!! $soal->pertanyaan !!}</p>
                <div class="mb-3">
                    <p>Jawaban Anda:
                        <span class="{{ $isCorrect ? 'correct-answer' : 'wrong-answer' }}">
                            {{ $jawaban->jawaban_siswa }}
                        </span>
                    </p>
                    <p>Kunci Jawaban:
                        <span class="correct-answer">
                            {{ $soal->kunci_jawaban }}
                        </span>
                    </p>
                </div>
                <div>
                    <h5 class="fw-bold text-primary">Pembahasan:</h5>
                    <p>{!! $soal->pembahasan !!}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection