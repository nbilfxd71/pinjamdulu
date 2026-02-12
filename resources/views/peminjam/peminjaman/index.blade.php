@extends('layouts.app')

@section('title', 'Daftar Peminjaman - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">📋 Riwayat Peminjaman Saya</h1>
        <a href="{{ route('peminjam.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Semua Peminjaman</h5>
        </div>
        <div class="card-body">
            @if($peminjamans->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="bi bi-box"></i> Alat</th>
                                <th><i class="bi bi-hash"></i> Jumlah</th>
                                <th><i class="bi bi-calendar"></i> Tgl Peminjaman</th>
                                <th><i class="bi bi-calendar-check"></i> Tgl Kembali Rencana</th>
                                <th><i class="bi bi-bookmark"></i> Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $peminjaman)
                                <tr>
                                    <td><strong>{{ $peminjaman->alat->nama }}</strong></td>
                                    <td><span class="badge bg-light text-dark">{{ $peminjaman->jumlah }}</span></td>
                                    <td>{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</td>
                                    <td>{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</td>
                                    <td>
                                        @if($peminjaman->status === 'pending')
                                            <span class="badge bg-warning">⏳ Pending</span>
                                        @elseif($peminjaman->status === 'disetujui')
                                            <span class="badge bg-success">✓ Disetujui</span>
                                        @elseif($peminjaman->status === 'ditolak')
                                            <span class="badge bg-danger">✕ Ditolak</span>
                                        @else
                                            <span class="badge bg-info">↩ Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $peminjamans->links() }}
                </div>
            @else
                <div class="alert alert-info text-center py-5" style="border-radius: 8px;">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #0066cc;"></i>
                    <h4 class="mt-3">Belum ada peminjaman</h4>
                    <p class="text-muted">Mulai dengan <a href="{{ route('peminjam.alats.index') }}">ajukan peminjaman alat</a></p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
