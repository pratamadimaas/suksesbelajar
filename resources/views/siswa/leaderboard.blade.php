@extends('layouts.app')

@section('title', 'Leaderboard')

@push('styles')
<style>
/* Container */
.leaderboard-container {
    max-width: 950px;
    margin: auto;
}

/* Card utama */
.leaderboard-card {
    background-color: #ffffff; /* Putih dominan */
    border-radius: 1.5rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    padding: 2.5rem;
}

/* Header */
.leaderboard-header {
    text-align: center;
    margin-bottom: 2rem;
}
.leaderboard-header h2 {
    font-weight: 700;
    color: #047857; /* Hijau tua */
}
.leaderboard-header p {
    color: #6b7280; /* Abu medium */
}

/* Table */
.table-leaderboard {
    border-radius: 1rem;
    overflow: hidden;
}
.table-leaderboard thead th {
    background-color: #059669; /* Hijau toska */
    color: #ffffff;
    border: none;
    padding: 1rem;
    font-weight: 600;
}
.table-leaderboard tbody tr {
    transition: background-color 0.2s ease;
}
.table-leaderboard tbody tr:hover {
    background-color: #f9fafb; /* Light Gray */
}
.table-leaderboard tbody tr.highlight-user {
    background-color: #d1fae5; /* Hijau pastel */
    border-left: 6px solid #059669; /* Hijau toska */
    font-weight: 600;
}

/* Rank Badge */
.rank-badge {
    font-size: 1rem;
    padding: 0.6rem 1rem;
    border-radius: 50%;
    color: #fff;
}
.rank-1 { background-color: #f97316; } /* Oranye terang */
.rank-2 { background-color: #059669; } /* Hijau toska */
.rank-3 { background-color: #047857; } /* Hijau tua */
.rank-other { background-color: #6b7280; } /* Abu medium */

/* Profile */
.profile-info {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}
.profile-info img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.profile-info .name {
    margin: 0;
    font-weight: 500;
    color: #1f2937; /* Dark */
}

/* Skor Badge */
.score-badge {
    background-color: #059669;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.4rem 0.9rem;
    border-radius: 0.75rem;
}
</style>
@endpush

@section('content')
<div class="leaderboard-container py-5">
    <div class="leaderboard-card">

        <!-- Header -->
        <div class="leaderboard-header">
            <h2>🏆 Leaderboard Ujian</h2>
            <p>Lihat posisi Anda dan bandingkan dengan peserta lain.</p>
        </div>

        <!-- Filter Paket -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="mb-3 mb-md-0 w-100 me-md-3">
                <label for="paketSelect" class="form-label fw-bold">📘 Pilih Paket Ujian:</label>
                <select class="form-select form-select-lg" id="paketSelect">
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                            {{ $paket->nama_paket }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @if(auth()->user()->role->name === 'admin' && request('paket_id'))
                <div class="d-flex align-self-end">
                    <form action="{{ route('ujian.reset', request('paket_id')) }}" method="POST" 
                          onsubmit="return confirm('Reset semua data leaderboard untuk paket ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg text-nowrap">Reset Leaderboard</button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Tabel Leaderboard -->
        <div class="table-responsive table-leaderboard">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center">Rank</th>
                        <th>Nama Peserta</th>
                        <th class="text-center">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @if($ujians->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data peringkat untuk paket ini.</td>
                        </tr>
                    @else
                        @foreach($ujians as $index => $ujian)
                        @php
                            $rank = ($ujians->currentPage() - 1) * $ujians->perPage() + $index + 1;
                        @endphp
                        <tr class="{{ Auth::id() == $ujian->user_id ? 'highlight-user' : '' }}">
                            <td class="text-center">
                                <span class="rank-badge {{ $rank == 1 ? 'rank-1' : ($rank == 2 ? 'rank-2' : ($rank == 3 ? 'rank-3' : 'rank-other')) }}">
                                    {{ $rank }}
                                </span>
                            </td>
                            <td>
                                <div class="profile-info">
                                    <img src="https://placehold.co/40x40/adb5bd/495057?text={{ substr($ujian->user->name, 0, 1) }}" alt="{{ $ujian->user->name }}">
                                    <span class="name">{{ $ujian->user->name }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="score-badge">{{ $ujian->total_skor }}</span>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ujians->links() }}
        </div>
    </div>
</div>

<script>
document.getElementById('paketSelect').addEventListener('change', function() {
    const paketId = this.value;
    const baseUrl = "{{ route('ujian.leaderboard') }}";
    window.location.href = paketId ? baseUrl + "?paket_id=" + paketId : baseUrl;
});
</script>
@endsection
