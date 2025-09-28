@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<div class="container py-4">
<div class="row">
<div class="col-lg-8 mx-auto text-center">
<h1 class="display-4 fw-bold mb-3">Sistem Ujian Online</h1>
<p class="lead mb-4">
Uji kemampuan Anda dengan berbagai paket soal Tryout CPNS yang tersedia.
Pilih paket yang Anda inginkan dan mulai ujian sekarang juga!
</p>
<a href="#paket-ujian" class="btn btn-primary btn-lg">Lihat Paket Ujian</a>
</div>
</div>
</div>

<div class="container py-5" id="paket-ujian">
<h2 class="text-center mb-5 fw-bold">Pilihan Paket Ujian</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($pakets as $paket)
    <div class="col">
        <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold text-primary">{{ $paket->nama_paket }}</h5>
                <p class="card-text text-muted">{{ $paket->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                <ul class="list-unstyled mt-3 mb-4">
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-clock-fill text-info me-2"></i>
                        <p class="mb-0">{{ $paket->waktu_ujian }} menit</p>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-file-earmark-text-fill text-info me-2"></i>
                        <p class="mb-0">{{ $paket->getTotalSoal() }} Soal</p>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-light border-0 pt-0 pb-3">
                <a href="{{ route('ujian.show', $paket->id) }}" class="btn btn-primary w-100">Mulai Ujian</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <div class="alert alert-info text-center" role="alert">
            Belum ada paket ujian yang tersedia saat ini.
        </div>
    </div>
    @endforelse
</div>

</div>
@endsection