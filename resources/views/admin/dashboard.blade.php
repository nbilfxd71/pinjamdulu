@extends('layouts.app')

@section('title', 'Admin Dashboard - Pinjamdulu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">📊 Dashboard Admin</h1>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <h6>Total Users</h6>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #e74c3c;">
                <h6>Total Alats</h6>
                <h3>{{ $totalAlat }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #3498db;">
                <h6>Total Peminjaman</h6>
                <h3>{{ $totalPeminjaman }}</h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="stat-card" style="background: #27ae60;">
                <h6>Pending</h6>
                <h3>{{ $peminjamanPending }}</h3>
            </div>
        </div>
    </div>

    <!-- Main Cards -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-graph-up"></i> Status Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <span class="badge bg-warning">Pending</span>
                        <span class="fw-bold">{{ $peminjamanPending }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <span class="badge bg-success">Disetujui</span>
                        <span class="fw-bold">{{ $peminjamanDisetujui }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="badge bg-info">Dikembalikan</span>
                        <span class="fw-bold">{{ $peminjamanDikembalikan }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-lightning-fill"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah User
                        </a>
                        <a href="{{ route('admin.alats.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Alat
                        </a>
                        <a href="{{ route('admin.kategoris.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori
                        </a>
                        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-info">
                            <i class="bi bi-list"></i> Lihat Semua Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-clock-history"></i> Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Aksi</th>
                                    <th>Entitas</th>
                                    <th>Detail</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAktivitas as $log)
                                    <tr>
                                        <td>{{ $log->user->name }}</td>
                                        <td><span class="badge bg-info">{{ $log->aksi }}</span></td>
                                        <td>{{ $log->entitas }}</td>
                                        <td>{{ $log->detail }}</td>
                                        <td><small class="text-muted">{{ $log->created_at->diffForHumans() }}</small></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Tidak ada aktivitas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
