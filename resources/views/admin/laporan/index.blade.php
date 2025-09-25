@extends('layouts.admin')

@section('title', 'Laporan Hasil Ujian')

@push('styles')
<style>
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

<h2 class="mb-4">Laporan dan Leaderboard Hasil Ujian</h2>

<ul class="nav nav-tabs mb-4" id="reportTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="laporan-tab" data-bs-toggle="tab" href="#laporan-content" role="tab" aria-controls="laporan-content" aria-selected="true">Laporan Detail</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="leaderboard-tab" data-bs-toggle="tab" href="#leaderboard-content" role="tab" aria-controls="leaderboard-content" aria-selected="false">Leaderboard</a>
    </li>
</ul>

<div class="tab-content" id="reportTabsContent">
    {{-- TAB CONTENT UNTUK LAPORAN --}}
    <div class="tab-pane fade show active" id="laporan-content" role="tabpanel" aria-labelledby="laporan-tab">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="paket_id_laporan" class="form-label">Filter Paket</label>
                    <select name="paket_id_laporan" id="paket_id_laporan" class="form-select">
                        <option value="">Semua Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ request('paket_id_laporan') == $paket->id ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.laporan.export', ['type' => 'excel', 'paket_id' => request('paket_id_laporan'), 'tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}" class="btn btn-success me-2">Export Excel</a>
            <a href="{{ route('admin.laporan.export', ['type' => 'pdf', 'paket_id' => request('paket_id_laporan'), 'tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}" class="btn btn-danger">Export PDF</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Paket Ujian</th>
                        <th>Skor TWK</th>
                        <th>Skor TIU</th>
                        <th>Skor TKP</th>
                        <th>Total Skor</th>
                        <th>Waktu Ujian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan_ujians as $ujian)
                        <tr>
                            <td>{{ ($laporan_ujians->currentPage() - 1) * $laporan_ujians->perPage() + $loop->iteration }}</td>
                            <td>{{ $ujian->user->name }}</td>
                            <td>{{ $ujian->paket->nama_paket }}</td>
                            <td>{{ $ujian->skor_twk }}</td>
                            <td>{{ $ujian->skor_tiu }}</td>
                            <td>{{ $ujian->skor_tkp }}</td>
                            <td>{{ $ujian->total_skor }}</td>
                            <td>{{ $ujian->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.ujian.destroy', $ujian->id) }}" method="POST" onsubmit="return confirm('Hapus data ujian ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $laporan_ujians->links() }}
        </div>
    </div>
    
    {{-- TAB CONTENT UNTUK LEADERBOARD --}}
    <div class="tab-pane fade" id="leaderboard-content" role="tabpanel" aria-labelledby="leaderboard-tab">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="mb-3 mb-md-0 w-100 me-md-3">
                <label for="paketSelectLeaderboard" class="form-label fw-bold">Pilih Paket Ujian:</label>
                <select class="form-select form-select-lg" id="paketSelectLeaderboard">
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}" {{ request('paket_id_leaderboard') == $paket->id ? 'selected' : '' }}>
                            {{ $paket->nama_paket }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @if(request('paket_id_leaderboard'))
                <div class="d-flex align-self-end">
                    <form action="{{ route('admin.leaderboard.reset', request('paket_id_leaderboard')) }}" method="POST" onsubmit="return confirm('Reset semua data leaderboard untuk paket ini?');">
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
                    @if($leaderboard_ujians->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data peringkat untuk paket ini.</td>
                        </tr>
                    @else
                        @foreach($leaderboard_ujians as $index => $ujian)
                            <tr>
                                <td class="text-center">
                                    <span class="badge {{ ($leaderboard_ujians->currentPage() - 1) * $leaderboard_ujians->perPage() + $index + 1 <= 3 ? 'bg-primary' : 'bg-secondary' }} rounded-pill">{{ ($leaderboard_ujians->currentPage() - 1) * $leaderboard_ujians->perPage() + $index + 1 }}</span>
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
            {{ $leaderboard_ujians->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paketSelectLeaderboard = document.getElementById('paketSelectLeaderboard');
        const reportTabs = new bootstrap.Tab(document.getElementById('leaderboard-tab'));

        paketSelectLeaderboard.addEventListener('change', function() {
            const paketId = this.value;
            const baseUrl = "{{ route('admin.laporan.index') }}";
            const currentUrl = new URL(window.location.href);
            
            if (paketId) {
                currentUrl.searchParams.set('paket_id_leaderboard', paketId);
            } else {
                currentUrl.searchParams.delete('paket_id_leaderboard');
            }
            
            // Simpan tab yang aktif
            currentUrl.searchParams.set('tab', 'leaderboard');

            window.location.href = currentUrl.toString();
        });

        // Logika untuk mempertahankan tab yang aktif setelah refresh
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab === 'leaderboard') {
            const tabElement = document.getElementById('leaderboard-tab');
            if (tabElement) {
                new bootstrap.Tab(tabElement).show();
            }
        }
    });
</script>
@endpush
