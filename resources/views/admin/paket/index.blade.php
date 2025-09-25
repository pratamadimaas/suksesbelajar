@extends('layouts.admin')

@section('title', 'Manajemen Paket Ujian')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.paket.create') }}" class="btn btn-primary">Tambah Paket</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Paket</th>
                <th>Jumlah Soal</th>
                <th>Waktu Ujian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pakets as $paket)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paket->nama_paket }}</td>
                <td>{{ $paket->soals_count }}</td>
                <td>{{ $paket->waktu_ujian }} menit</td>
                <td>
                    <span class="badge {{ $paket->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $paket->is_active ? 'Aktif' : 'Non-aktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.paket.show', $paket) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                    <a href="{{ route('admin.paket.edit', $paket) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('admin.paket.assign', $paket) }}" class="btn btn-sm btn-success text-white">Atur Soal</a>
                    <form action="{{ route('admin.paket.destroy', $paket) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada paket ujian yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
