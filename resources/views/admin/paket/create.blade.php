@extends('layouts.admin')

@section('title', 'Tambah Paket Ujian Baru')

@section('content')

<div class="card shadow-sm">
<div class="card-header">
<h5 class="mb-0">Form Tambah Paket</h5>
</div>
<div class="card-body">
<form action="{{ route('admin.paket.store') }}" method="POST">
@csrf

        <div class="mb-3">
            <label for="nama_paket" class="form-label">Nama Paket</label>
            <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket') }}" required>
            @error('nama_paket')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="jumlah_soal_twk" class="form-label">Jumlah Soal TWK</label>
                <input type="number" class="form-control @error('jumlah_soal_twk') is-invalid @enderror" id="jumlah_soal_twk" name="jumlah_soal_twk" value="{{ old('jumlah_soal_twk') }}" min="1" required>
                @error('jumlah_soal_twk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="jumlah_soal_tiu" class="form-label">Jumlah Soal TIU</label>
                <input type="number" class="form-control @error('jumlah_soal_tiu') is-invalid @enderror" id="jumlah_soal_tiu" name="jumlah_soal_tiu" value="{{ old('jumlah_soal_tiu') }}" min="1" required>
                @error('jumlah_soal_tiu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="jumlah_soal_tkp" class="form-label">Jumlah Soal TKP</label>
                <input type="number" class="form-control @error('jumlah_soal_tkp') is-invalid @enderror" id="jumlah_soal_tkp" name="jumlah_soal_tkp" value="{{ old('jumlah_soal_tkp') }}" min="1" required>
                @error('jumlah_soal_tkp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="waktu_ujian" class="form-label">Waktu Ujian (menit)</label>
            <input type="number" class="form-control @error('waktu_ujian') is-invalid @enderror" id="waktu_ujian" name="waktu_ujian" value="{{ old('waktu_ujian') }}" min="30" required>
            @error('waktu_ujian')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</div>
@endsection