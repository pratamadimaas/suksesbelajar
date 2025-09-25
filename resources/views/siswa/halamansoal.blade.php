@extends('layouts.app')

@section('title', 'Ujian - Soal ' . $nomor)

@push('styles')

<style>
.soal-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
    gap: 8px;
}
.soal-btn {
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    text-decoration: none;
    color: #212529;
}
.soal-btn.answered {
    background-color: #28a745;
    color: white;
}
.soal-btn.current {
    background-color: #007bff;
    color: white;
}
/* Custom Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0,0,0,0.5);
}
.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px;
    text-align: center;
}
.modal-footer {
    padding-top: 15px;
    border-top: 1px solid #eee;
}
.close-modal {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close-modal:hover,
.close-modal:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Soal Nomor {{ $nomor }}
                </div>
                <div class="card-body">
                    <p class="lead">{{ $currentSoal->soal->pertanyaan }}</p>
                    <form id="jawabanForm" data-ujian-id="{{ $ujian->id }}" data-soal-id="{{ $currentSoal->soal->id }}">
                        @csrf
                        <div class="list-group">
                            @foreach($currentSoal->soal->getPilihanArray() as $pilihan => $teks)
                            <label class="list-group-item">
                                <input type="radio" name="jawaban" value="{{ $pilihan }}" {{ $currentSoal->jawaban === $pilihan ? 'checked' : '' }}>
                                <span class="ms-2">{{ $teks }}</span>
                            </label>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    @if ($nomor > 1)
                    <a href="{{ route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => $nomor - 1]) }}" class="btn btn-secondary">Sebelumnya</a>
                    @else
                    <span></span>
                    @endif
                    @if ($nomor < $totalSoal)
                    <a href="{{ route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => $nomor + 1]) }}" class="btn btn-primary">Selanjutnya</a>
                    @else
                    <form action="{{ route('ujian.submit', $ujian) }}" method="POST" id="finishExamForm">
                        @csrf
                        <button type="submit" class="btn btn-success">Selesai Ujian</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">Informasi Ujian</div>
                <div class="card-body">
                    <p><strong>Paket:</strong> {{ $ujian->paket->nama_paket }}</p>
                    <p><strong>Sisa Waktu:</strong> <span id="sisaWaktu">{{ gmdate("H:i:s", $sisaWaktu) }}</span></p>
                    <p><strong>Progress:</strong> {{ $nomor }} dari {{ $totalSoal }} soal</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info text-white">Daftar Soal</div>
                <div class="card-body">
                    <div class="soal-list">
                        @foreach ($soals as $i => $soalItem)
                        <a href="{{ route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => $i + 1]) }}" class="soal-btn {{ $soalItem->jawaban ? 'answered' : '' }} {{ $nomor === $i + 1 ? 'current' : '' }}">
                            {{ $i + 1 }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    // Timer
    let sisaWaktu = {{ $sisaWaktu }};
    const timerElement = document.getElementById('sisaWaktu');
    const interval = setInterval(() => {
        if (sisaWaktu <= 0) {
            clearInterval(interval);
            // Submit form secara otomatis saat waktu habis
            document.getElementById('finishExamForm').submit();
            return;
        }
        sisaWaktu--;
        let hours = Math.floor(sisaWaktu / 3600);
        let minutes = Math.floor((sisaWaktu % 3600) / 60);
        let seconds = sisaWaktu % 60;
        timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);

    // Kirim jawaban via AJAX
    const form = document.getElementById('jawabanForm');
    form.addEventListener('change', (event) => {
        const ujianId = form.dataset.ujianId;
        const soalId = form.dataset.soalId;
        const jawaban = event.target.value;

        // Menggunakan fetch() sebagai pengganti Axios
        fetch(`/ujian/${ujianId}/jawab`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                soal_id: soalId,
                jawaban: jawaban
            })
        })
        .then(response => {
            if (response.ok) {
                // Update tampilan soal list
                const soalBtn = document.querySelector(`.soal-btn:nth-child(${nomor})`);
                if (soalBtn) {
                    soalBtn.classList.add('answered');
                }
                return response.json();
            }
            throw new Error('Gagal menyimpan jawaban.');
        })
        .then(data => {
            console.log("Jawaban berhasil disimpan.", data);
        })
        .catch(error => {
            console.error("Error saat menyimpan jawaban:", error);
        });
    });

</script>

@endpush
