@extends('layouts.app')

@section('title', 'Daftar Pengembalian - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Pengembalian</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $pengembalian)
                            <tr>
                                <td>{{ $pengembalian->peminjaman->user->name }}</td>
                                <td>{{ $pengembalian->peminjaman->alat->nama }}</td>
                                <td>{{ $pengembalian->tanggal_pengembalian->format('d-m-Y') }}</td>
                                <td>
                                    @if($pengembalian->kondisi_alat === 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($pengembalian->kondisi_alat === 'cacat')
                                        <span class="badge bg-warning">Cacat</span>
                                    @else
                                        <span class="badge bg-danger">Hilang</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pengembalian->denda > 0)
                                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pengembalian.show', $pengembalian->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('admin.pengembalian.edit', $pengembalian->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pengembalians->links() }}
        </div>
    </div>
</div>
@endsection
