@extends('layouts.app')

@section('title', 'Peminjam Dashboard - Pinjamdulu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">📚 Dashboard Peminjam</h1>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <h6>Total Peminjaman</h6>
                <h3>{{ $totalPeminjaman }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #e74c3c;">
                <h6>Peminjaman Aktif</h6>
                <h3>{{ $peminjamanAktif }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #3498db;">
                <h6>Pending Approval</h6>
                <h3>{{ $peminjamanPending }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #27ae60;">
                <h6>Sudah Dikembalikan</h6>
                <h3>{{ $peminjamanDikembalikan }}</h3>
            </div>
        </div>
    </div>

    <!-- Recent Borrowing History -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Riwayat Peminjaman Terbaru</h5>
                        <a href="{{ route('peminjam.alats.index') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajukan Peminjaman
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
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
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada peminjaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Quick Actions & Status Summary -->
    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-lightning-fill"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('peminjam.alats.index') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajukan Peminjaman Baru
                        </a>
                        <a href="{{ route('peminjam.peminjaman.index') }}" class="btn btn-info">
                            <i class="bi bi-list"></i> Lihat Semua Peminjaman
                        </a>
                        <a href="{{ route('peminjam.pengembalian.index') }}" class="btn btn-warning">
                            <i class="bi bi-arrow-up-circle"></i> Alat yang Harus Dikembalikan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Ringkasan Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <span class="badge bg-warning">Pending</span>
                        <span class="fw-bold">{{ $peminjamanPending }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <span class="badge bg-success">Disetujui</span>
                        <span class="fw-bold">{{ $peminjamanAktif }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="badge bg-info">Dikembalikan</span>
                        <span class="fw-bold">{{ $peminjamanDikembalikan }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
