@extends('layouts.admin')

@section('title', 'Tugaskan Paket ke ' . $user->name)

@section('content')

<div class="row">
<div class="col-12">
<div class="card shadow-sm rounded-lg border-0">
<div class="card-body p-4">

            <h4 class="card-title mb-4">Tugaskan Paket untuk: <span class="text-primary">{{ $user->name }}</span> ({{ $user->email }})</h4>

            <form action="{{ route('admin.users.save-assign', $user) }}" method="POST">
                @csrf

                <div class="list-group mb-4">
                    @forelse ($pakets as $paket)
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <input class="form-check-input me-3" type="checkbox" name="paket_ids[]" value="{{ $paket->id }}" 
                                    {{ in_array($paket->id, $assignedPaketIds) ? 'checked' : '' }}>
                                
                                {{ $paket->nama_paket }} 
                            </div>
                            <span class="badge bg-secondary rounded-pill">{{ $paket->soals_count ?? 0 }} Soal</span>
                        </label>
                    @empty
                        <p class="text-center text-muted m-3">Belum ada Paket Ujian yang tersedia. Silakan buat paket terlebih dahulu.</p>
                    @endforelse
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Pengguna
                    </a>
                    <button type="submit" class="btn btn-success action-btn">
                        <i class="bi bi-save me-1"></i> Simpan Penugasan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

</div>
@endsection