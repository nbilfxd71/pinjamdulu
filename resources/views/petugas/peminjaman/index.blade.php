@extends('layouts.app')

@section('title', 'Daftar Peminjaman - Petugas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Peminjaman</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Kembali Rencana</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->alat->nama }}</td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</td>
                                <td>{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</td>
                                <td>
                                    @if($peminjaman->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($peminjaman->status === 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($peminjaman->status === 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-info">Dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('petugas.peminjaman.show', $peminjaman->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
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
            {{ $peminjamans->links() }}
        </div>
    </div>
</div>
@endsection
