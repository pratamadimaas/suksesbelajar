@extends('layouts.app')

@section('title', 'Leaderboard')

@push('styles')

<style>
.leaderboard-container {
max-width: 900px;
margin: auto;
}
.leaderboard-card {
background-color: #ffffff;
border-radius: 1.5rem;
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
padding: 2.5rem;
transition: transform 0.3s ease-in-out;
}
.leaderboard-card:hover {
transform: translateY(-5px);
}
.table-leaderboard {
border-radius: 1rem;
overflow: hidden;
}
.table-leaderboard thead th {
background-color: #4c51bf;
color: white;
font-weight: 600;
border: none;
padding: 1rem;
}
.table-leaderboard tbody tr {
transition: background-color 0.2s ease, transform 0.2s ease;
}
.table-leaderboard tbody tr:hover {
background-color: #eef2ff;
}
.table-leaderboard tbody tr.highlight-user {
background-color: #fff3cd; /* Warna kuning dari Bootstrap Warning */
font-weight: bold;
}
.table-leaderboard tbody tr.highlight-user:hover {
background-color: #ffe6a7;
}
.profile-info {
display: flex;
align-items: center;
gap: 1rem;
}
.profile-info img {
width: 40px;
height: 40px;
border-radius: 50%;
border: 2px solid #ddd;
}
.profile-info .name {
margin: 0;
font-weight: 500;
color: #2d3748;
}
</style>

@endpush

@section('content')

<div class="leaderboard-container py-5">
<div class="leaderboard-card">
<h2 class="card-title fw-bold mb-3 text-center">Leaderboard Ujian</h2>
<p class="text-muted mb-4 text-center">Lihat peringkat Anda dan bandingkan dengan peserta lain.</p>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <div class="mb-3 mb-md-0 w-100 me-md-3">
            <label for="paketSelect" class="form-label fw-bold">Pilih Paket Ujian:</label>
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
                <form action="{{ route('ujian.reset', request('paket_id')) }}" method="POST" onsubmit="return confirm('Reset semua data leaderboard untuk paket ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg text-nowrap">Reset Leaderboard</button>
                </form>
            </div>
        @endif
    </div>
    
    <div class="table-responsive table-leaderboard">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col" class="text-center">Skor</th>
                </tr>
            </thead>
            <tbody>
                @if($ujians->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">Belum ada data peringkat untuk paket ini.</td>
                    </tr>
                @else
                    @foreach($ujians as $index => $ujian)
                    <tr class="{{ Auth::id() == $ujian->user_id ? 'highlight-user' : '' }}">
                        <td class="text-center">
                            <span class="badge {{ ($ujians->currentPage() - 1) * $ujians->perPage() + $index + 1 <= 3 ? 'bg-primary' : 'bg-secondary' }} rounded-pill">{{ ($ujians->currentPage() - 1) * $ujians->perPage() + $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="profile-info">
                                <img src="https://placehold.co/40x40/adb5bd/495057?text={{ substr($ujian->user->name, 0, 1) }}" alt="{{ $ujian->user->name }}'s profile picture">
                                <span class="name">{{ $ujian->user->name }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success fs-6">{{ $ujian->total_skor }}</span>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $ujians->links() }}
    </div>
</div>

</div>

<script>
document.getElementById('paketSelect').addEventListener('change', function() {
const paketId = this.value;
const baseUrl = "{{ route('ujian.leaderboard') }}";
if (paketId) {
window.location.href = baseUrl + "?paket_id=" + paketId;
} else {
window.location.href = baseUrl;
}
});
</script>

@endsection