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
}

.action-btn:hover {
    opacity: 0.8;
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

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{-- Tombol Reset Password --}}
                                        <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset kata sandi pengguna ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-warning text-white action-btn">
                                                <i class="bi bi-key-fill me-1"></i> Reset Password
                                            </button>
                                        </form>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger action-btn">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
