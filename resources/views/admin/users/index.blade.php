@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@push('styles')

<style>
.table-responsive {
border-radius: 0.75rem;
overflow-x: auto;
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
.table {
margin-bottom: 0;
background-color: #ffffff;
}
.table thead th {
background-color: #f8f9fa;
color: #495057;
font-weight: 600;
border-bottom: 2px solid #e9ecef;
padding: 1rem;
}
.table tbody tr:hover {
background-color: #f0f2f5;
transition: background-color 0.2s ease;
}
.table tbody td {
padding: 1rem;
vertical-align: middle;
border-top: 1px solid #e9ecef;
}
.action-btn {
font-size: 0.875rem;
padding: 0.5rem 1rem;
border-radius: 0.5rem;
transition: background-color 0.2s ease;
text-transform: uppercase;
font-weight: 600;
margin-bottom: 0.5rem;
}
.action-btn:hover {
opacity: 0.8;
}
.massal-action-group {
display: flex;
align-items: center;
gap: 10px;
flex-wrap: wrap;
}
</style>

@endpush

@section('content')

<div class="row">
<div class="col-12">
<div class="card shadow-sm rounded-lg border-0">
<div class="card-body p-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="card-title m-0">Daftar Pengguna</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary action-btn">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Pengguna
    </a>
</div>

{{-- Form Search --}}
<form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..."
                value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i> Cari
        </button>
    </div>
</form>

{{-- Form Aksi Massal (Membungkus tabel) --}}
<form id="massAssignForm" method="POST" action="{{ route('admin.users.assign-selected') }}">
    @csrf
    
    {{-- Tombol Aksi Massal di Atas Tabel --}}
    <div class="massal-action-group mb-3 p-3 bg-light rounded-lg border">
        <label for="paketSelect" class="fw-bold m-0">Tugaskan Paket:</label>
        <select name="paket_id" id="paketSelect" class="form-select" style="width: 250px;" required>
            <option value="">-- Pilih Paket untuk Ditugaskan --</option>
            @foreach($pakets as $paket)
                <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
            @endforeach
        </select>
        <button type="submit" id="executeMassAssign" class="btn btn-success action-btn" disabled>
            <i class="bi bi-person-check-fill me-1"></i> Tugaskan ke yang Dipilih
        </button>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width: 5%;">
                        <input type="checkbox" id="selectAllUsers">
                    </th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi Individual</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            {{-- Checkbox untuk memilih pengguna. Namanya harus user_ids[] --}}
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                {{-- Tombol Tugaskan Paket (Sudah ada) --}}
                                <a href="{{ route('admin.users.assign-paket', $user) }}" class="btn btn-info text-white action-btn">
                                    <i class="bi bi-box-seam me-1"></i> Tugaskan Paket
                                </a>
                                
                                {{-- Tombol Reset Password (Sudah ada) --}}
                                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset kata sandi pengguna ini?');">
                                    @csrf
                                    <button type="submit" class="btn btn-warning text-white action-btn">
                                        <i class="bi bi-key-fill me-1"></i> Reset Password
                                    </button>
                                </form>

                                {{-- Tombol Hapus (Sudah ada) --}}
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger action-btn">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada pengguna ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

{{-- Pagination --}}
<div class="mt-3">
    {{ $users->withQueryString()->links() }}
</div>

</div>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
const selectAllCheckbox = document.getElementById('selectAllUsers');
const userCheckboxes = document.querySelectorAll('.user-checkbox');
const executeButton = document.getElementById('executeMassAssign');
const paketSelect = document.getElementById('paketSelect');

    // Fungsi Toggle Tombol Submit
    function toggleButton() {
        const anyChecked = Array.from(userCheckboxes).some(cb =&gt; cb.checked);
        const paketSelected = paketSelect.value !== &#39;&#39;;
        
        // Tombol diaktifkan jika setidaknya satu pengguna dicentang DAN satu paket dipilih
        executeButton.disabled = !(anyChecked &amp;&amp; paketSelected);
    }

    // 1. Event Listener Pilih Semua
    selectAllCheckbox.addEventListener(&#39;change&#39;, function () {
        userCheckboxes.forEach(checkbox =&gt; {
            checkbox.checked = selectAllCheckbox.checked;
        });
        toggleButton();
    });

    // 2. Event Listener Perubahan Checkbox dan Select
    userCheckboxes.forEach(checkbox =&gt; {
        checkbox.addEventListener(&#39;change&#39;, toggleButton);
    });
    
    paketSelect.addEventListener(&#39;change&#39;, toggleButton);

    // Panggil toggleButton saat halaman dimuat untuk inisialisasi status tombol
    toggleButton();
});

</script>

@endsection
