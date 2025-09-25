@extends('layouts.admin')

@section('title', 'Detail Soal')

@section('content')
<div class="card">
<div class="card-header">Detail Soal</div>
<div class="card-body">
<p><strong>Kategori:</strong> {{ $soal->kategori }}</p>
<p><strong>Pertanyaan:</strong></p>
<div class="border p-3 mb-3">{{ $soal->pertanyaan }}</div>
<p><strong>Pilihan A:</strong> {{ $soal->pilihan_a }}</p>
<p><strong>Pilihan B:</strong> {{ $soal->pilihan_b }}</p>
<p><strong>Pilihan C:</strong> {{ $soal->pilihan_c }}</p>
<p><strong>Pilihan D:</strong> {{ $soal->pilihan_d }}</p>
<p><strong>Pilihan E:</strong> {{ $soal->pilihan_e }}</p>
<p><strong>Kunci Jawaban:</strong> {{ $soal->kunci_jawaban }}</p>
@if ($soal->kategori === 'TKP')
<p><strong>Skor A:</strong> {{ $soal->skor_a }}</p>
<p><strong>Skor B:</strong> {{ $soal->skor_b }}</p>
<p><strong>Skor C:</strong> {{ $soal->skor_c }}</p>
<p><strong>Skor D:</strong> {{ $soal->skor_d }}</p>
<p><strong>Skor E:</strong> {{ $soal->skor_e }}</p>
@endif
<p><strong>Pembahasan:</strong> {{ $soal->pembahasan }}</p>
<a href="{{ route('admin.soal.index') }}" class="btn btn-secondary">Kembali</a>
</div>
</div>
@endsection