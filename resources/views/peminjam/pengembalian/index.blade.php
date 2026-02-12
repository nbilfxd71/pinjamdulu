@extends('layouts.app')

@section('title', 'Pengembalian Alat - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">↩️ Alat yang Harus Dikembalikan</h1>
        <a href="{{ route('peminjam.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-arrow-up-circle"></i> Daftar Pengembalian</h5>
        </div>
        <div class="card-body">
            @if($pengembalians->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="bi bi-box"></i> Alat</th>
                                <th><i class="bi bi-hash"></i> Jumlah</th>
                                <th><i class="bi bi-calendar"></i> Tgl Peminjaman</th>
                                <th><i class="bi bi-calendar-check"></i> Tgl Kembali Rencana</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengembalians as $peminjaman)
                                <tr>
                                    <td><strong>{{ $peminjaman->alat->nama }}</strong></td>
                                    <td><span class="badge bg-light text-dark">{{ $peminjaman->jumlah }}</span></td>
                                    <td>{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Dalam Peminjaman</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('peminjam.pengembalian.create', $peminjaman->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-arrow-up-circle"></i> Kembalikan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $pengembalians->links() }}
                </div>
            @else
                <div class="alert alert-success text-center py-5" style="border-radius: 8px;">
                    <i class="bi bi-check-circle" style="font-size: 3rem; color: #43e97b;"></i>
                    <h4 class="mt-3">Tidak ada alat yang harus dikembalikan</h4>
                    <p class="text-muted">Semua alat sudah dikembalikan dengan baik</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
