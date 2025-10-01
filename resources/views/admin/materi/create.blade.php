@extends('layouts.admin')

@section('title', 'Tambah Materi Ajar')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Tambah Materi Ajar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Materi</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isi_materi" class="form-label">Isi Materi</label>
                            <textarea class="form-control @error('isi_materi') is-invalid @enderror" id="isi_materi" name="isi_materi" rows="10">{{ old('isi_materi') }}</textarea>
                            @error('isi_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File Materi (PDF/DOC)</label>
                            <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
                            <div class="form-text">Maksimum 10MB. Format yang didukung: PDF, DOC, DOCX.</div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Terbitkan Materi</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Materi</button>
                        <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection