@extends('layouts.app')

@section('title', 'Laporan - Petugas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Laporan Peminjaman</h1>
        <a href="{{ route('petugas.laporan.print') }}" class="btn btn-primary" target="_blank">
            <i class="bi bi-printer"></i> Cetak Laporan
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Total Peminjaman</h6>
                <h3>{{ $totalPeminjaman }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background: #e74c3c;">
                <h6>Total Pengembalian</h6>
                <h3>{{ $totalPengembalian }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background: #27ae60;">
                <h6>Total Denda</h6>
                <h3>Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Peminjaman dan Pengembalian</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tgl Peminjaman</th>
                            <th>Status</th>
                            <th>Tgl Kembali</th>
                            <th>Kondisi</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->alat->nama }}</td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</td>
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
                                <td>{{ $peminjaman->pengembalian?->tanggal_pengembalian?->format('d-m-Y') ?? '-' }}</td>
                                <td>
                                    @if($peminjaman->pengembalian)
                                        @if($peminjaman->pengembalian->kondisi_alat === 'baik')
                                            <span class="badge bg-success">Baik</span>
                                        @elseif($peminjaman->pengembalian->kondisi_alat === 'cacat')
                                            <span class="badge bg-warning">Cacat</span>
                                        @else
                                            <span class="badge bg-danger">Hilang</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                                        Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
