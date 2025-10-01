    @extends('layouts.app')

    @section('title', 'Materi Ajar')

    @section('content')
        <h2 class="mb-4 fw-bold text-dark">Koleksi Materi Ajar</h2>
        <p class="text-gray mb-5">Pelajari berbagai modul dan ringkasan yang disediakan oleh tim pengajar kami.</p>

        @if ($materis->isEmpty())
            <div class="alert alert-info text-center py-4" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i> Belum ada materi ajar yang tersedia saat ini.
            </div>
        @else
            <div class="row g-4">
                @foreach ($materis as $materi)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body">
                                <span class="badge bg-primary-custom mb-2">Materi Baru</span>
                                <h5 class="card-title fw-bold text-primary-dark">{{ $materi->judul }}</h5>
                                <p class="card-text text-gray small">{{ Str::limit($materi->deskripsi ?: strip_tags($materi->isi_materi), 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                                <a href="{{ route('siswa.materi.show', $materi->id) }}" class="btn btn-sm btn-primary-custom">
                                    Lihat Materi <i class="bi bi-arrow-right-short"></i>
                                </a>
                                @if ($materi->file_path)
                                    <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5 d-flex justify-content-center">
                {{ $materis->links() }}
            </div>
        @endif
    @endsection
    
