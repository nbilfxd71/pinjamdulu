@extends('layouts.app')

@section('title', 'Petugas Dashboard - Pinjamdulu')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard Petugas</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <h6>Peminjaman Pending</h6>
                <h3>{{ $peminjamanPending }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #e74c3c;">
                <h6>Peminjaman Disetujui</h6>
                <h3>{{ $peminjamanDisetujui }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #3498db;">
                <h6>Belum Dikembalikan</h6>
                <h3>{{ $peminjamanBelumDikembalikan }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #27ae60;">
                <h6>Pengembalian Hari Ini</h6>
                <h3>{{ $pengembalianHariIni }}</h3>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Peminjaman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Alat</th>
                                    <th>Jumlah</th>
                                    <th>Tgl Peminjaman</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPeminjamans as $peminjaman)
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
                                        <td>
                                            <a href="{{ route('petugas.peminjaman.show', $peminjaman->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> Lihat
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
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-sm btn-primary mb-2 w-100">
                        <i class="bi bi-list"></i> Lihat Semua Peminjaman
                    </a>
                    <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-sm btn-primary mb-2 w-100">
                        <i class="bi bi-list"></i> Lihat Pengembalian
                    </a>
                    <a href="{{ route('petugas.laporan.index') }}" class="btn btn-sm btn-primary w-100">
                        <i class="bi bi-file-earmark-pdf"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
