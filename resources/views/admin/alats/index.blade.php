@extends('layouts.app')

@section('title', 'Daftar Alat - Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Alat</h1>
        <a href="{{ route('admin.alats.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Alat
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Stok Tersedia</th>
                            <th>Nomor Seri</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alats as $alat)
                            <tr>
                                <td>{{ $alat->nama }}</td>
                                <td>{{ $alat->kategori->nama }}</td>
                                <td>{{ $alat->stok }}</td>
                                <td>{{ $alat->stok_tersedia }}</td>
                                <td>{{ $alat->nomor_seri ?? '-' }}</td>
                                <td>
                                    @if($alat->kondisi === 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($alat->kondisi === 'rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                    @else
                                        <span class="badge bg-warning">Perbaikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.alats.edit', $alat->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.alats.destroy', $alat->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $alats->links() }}
        </div>
    </div>
</div>
@endsection
