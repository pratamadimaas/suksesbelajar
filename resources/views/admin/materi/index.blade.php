@extends('layouts.admin')

@section('title', 'Materi Ajar')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Daftar Materi Ajar</h4>
                    <a href="{{ route('admin.materi.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Materi
                    </a>
                </div>
                <div class="card-body">
                    @if ($materis->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Belum ada materi ajar yang ditambahkan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materis as $materi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $materi->judul }}</strong><br>
                                                <small class="text-muted">{{ Str::limit($materi->deskripsi, 50) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge {{ $materi->is_published ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $materi->is_published ? 'Terbit' : 'Draft' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($materi->file_path)
                                                    <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                                        <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Lihat File
                                                    </a>
                                                @else
                                                    Tidak ada
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn btn-sm btn-warning text-white">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $materis->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection