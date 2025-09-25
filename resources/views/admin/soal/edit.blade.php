@extends('layouts.admin')

@section('title', 'Edit Soal')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Form Edit Soal</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.soal.update', $soal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    <option value="TWK" {{ old('kategori', $soal->kategori) == 'TWK' ? 'selected' : '' }}>TWK</option>
                    <option value="TIU" {{ old('kategori', $soal->kategori) == 'TIU' ? 'selected' : '' }}>TIU</option>
                    <option value="TKP" {{ old('kategori', $soal->kategori) == 'TKP' ? 'selected' : '' }}>TKP</option>
                </select>
                @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                <textarea name="pertanyaan" id="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" rows="4">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                @error('pertanyaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
                <div class="col-md-6 mb-3">
                    <label for="pilihan_{{ $option }}" class="form-label">Pilihan {{ strtoupper($option) }}</label>
                    <textarea name="pilihan_{{ $option }}" id="pilihan_{{ $option }}" class="form-control @error('pilihan_' . $option) is-invalid @enderror" rows="2">{{ old('pilihan_' . $option, $soal->{'pilihan_' . $option}) }}</textarea>
                    @error('pilihan_' . $option)
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="kunci_jawaban" class="form-label">Kunci Jawaban (TWK & TIU) / Opsi Jawaban (TKP)</label>
                <select name="kunci_jawaban" id="kunci_jawaban" class="form-select @error('kunci_jawaban') is-invalid @enderror">
                    <option value="">Pilih Kunci Jawaban</option>
                    @foreach (['A', 'B', 'C', 'D', 'E'] as $key)
                    <option value="{{ $key }}" {{ old('kunci_jawaban', $soal->kunci_jawaban) == $key ? 'selected' : '' }}>{{ $key }}</option>
                    @endforeach
                </select>
                @error('kunci_jawaban')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div id="tkp-skor-fields" style="display: none;">
                <hr>
                <h6 class="mb-3">Skor untuk Kategori TKP (1-5)</h6>
                <div class="row">
                    @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <label for="skor_{{ $option }}" class="form-label">Skor Pilihan {{ strtoupper($option) }}</label>
                        <input type="number" name="skor_{{ $option }}" id="skor_{{ $option }}" class="form-control @error('skor_' . $option) is-invalid @enderror" value="{{ old('skor_' . $option, $soal->{'skor_' . $option}) }}">
                        @error('skor_' . $option)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endforeach
                </div>
                <hr>
            </div>

            <div class="mb-3">
                <label for="pembahasan" class="form-label">Pembahasan (Opsional)</label>
                <textarea name="pembahasan" id="pembahasan" class="form-control @error('pembahasan') is-invalid @enderror" rows="3">{{ old('pembahasan', $soal->pembahasan) }}</textarea>
                @error('pembahasan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Soal</button>
            <a href="{{ route('admin.soal.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategori');
        const tkpSkorFields = document.getElementById('tkp-skor-fields');

        function toggleSkorFields() {
            if (kategoriSelect.value === 'TKP') {
                tkpSkorFields.style.display = 'block';
            } else {
                tkpSkorFields.style.display = 'none';
            }
        }

        kategoriSelect.addEventListener('change', toggleSkorFields);
        toggleSkorFields(); // Panggil saat halaman dimuat
    });
</script>
@endpush