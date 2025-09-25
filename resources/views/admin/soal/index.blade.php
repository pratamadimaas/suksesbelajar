@extends('layouts.admin')

@section('title', 'Manajemen Soal')

@section('content')
<div class="d-flex justify-content-end mb-3">
<a href="{{ route('admin.soal.create') }}" class="btn btn-primary">Tambah Soal</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Pertanyaan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($soals as $soal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $soal->kategori }}</td>
                    <td>{{ Str::limit($soal->pertanyaan, 50) }}</td>
                    <td>
                        <span class="badge {{ $soal->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $soal->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.soal.show', $soal) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                        <a href="{{ route('admin.soal.edit', $soal) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.soal.destroy', $soal) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada soal yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $soals->links() }}
</div>

@endsection