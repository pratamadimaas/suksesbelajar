@extends('layouts.admin')

@section('title', 'Tetapkan Soal untuk ' . $paket->nama_paket)

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Tetapkan Soal untuk Paket: **{{ $paket->nama_paket }}**</h5>
        <small class="text-muted">Pilih {{ $paket->jumlah_soal_twk }} soal TWK, {{ $paket->jumlah_soal_tiu }} soal TIU, dan {{ $paket->jumlah_soal_tkp }} soal TKP.</small>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.paket.save-soal', $paket) }}" method="POST">
            @csrf
            
            <div class="accordion" id="accordionSoal">
                <!-- TWK Questions -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Soal TWK ({{ $soals->where('kategori', 'TWK')->count() }})
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            @foreach ($soals->where('kategori', 'TWK') as $soal)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="soal_ids[]" value="{{ $soal->id }}" id="soal-{{ $soal->id }}" 
                                        {{ in_array($soal->id, $assignedSoalIds) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="soal-{{ $soal->id }}">
                                        {!! Str::limit($soal->pertanyaan, 100) !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- TIU Questions -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Soal TIU ({{ $soals->where('kategori', 'TIU')->count() }})
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @foreach ($soals->where('kategori', 'TIU') as $soal)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="soal_ids[]" value="{{ $soal->id }}" id="soal-{{ $soal->id }}" 
                                        {{ in_array($soal->id, $assignedSoalIds) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="soal-{{ $soal->id }}">
                                        {!! Str::limit($soal->pertanyaan, 100) !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- TKP Questions -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            Soal TKP ({{ $soals->where('kategori', 'TKP')->count() }})
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @foreach ($soals->where('kategori', 'TKP') as $soal)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="soal_ids[]" value="{{ $soal->id }}" id="soal-{{ $soal->id }}" 
                                        {{ in_array($soal->id, $assignedSoalIds) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="soal-{{ $soal->id }}">
                                        {!! Str::limit($soal->pertanyaan, 100) !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Simpan Soal</button>
            <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
</div>
@endsection
