@extends('layouts.app')

@section('title', 'Detail Peminjaman - Petugas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Detail Peminjaman</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Peminjam:</strong><br>
                            {{ $peminjaman->user->name }}<br>
                            <small class="text-muted">{{ $peminjaman->user->email }}</small><br>
                            <small>{{ $peminjaman->user->nomor_identitas ?? '-' }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong><br>
                            @if($peminjaman->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($peminjaman->status === 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($peminjaman->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-info">Dikembalikan</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Alat:</strong><br>
                            {{ $peminjaman->alat->nama }}
                        </div>
                        <div class="col-md-6">
                            <strong>Jumlah:</strong><br>
                            {{ $peminjaman->jumlah }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Peminjaman:</strong><br>
                            {{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Kembali Rencana:</strong><br>
                            {{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}
                        </div>
                    </div>

                    @if($peminjaman->pengembalian)
                    <div class="alert alert-info">
                        <strong>Sudah dikembalikan pada:</strong> {{ $peminjaman->pengembalian->tanggal_pengembalian->format('d-m-Y') }}<br>
                        <strong>Kondisi:</strong> {{ ucfirst($peminjaman->pengembalian->kondisi_alat) }}<br>
                        @if($peminjaman->pengembalian->denda > 0)
                        <strong>Denda:</strong> Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                        @endif
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <strong>Status:</strong> Alat belum dikembalikan
                    </div>
                    @endif
                </div>
            </div>

            @if($peminjaman->status === 'pending')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('petugas.peminjaman.approve', $peminjaman->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success me-2">
                            <i class="bi bi-check-circle"></i> Setujui Peminjaman
                        </button>
                    </form>

                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="bi bi-x-circle"></i> Tolak Peminjaman
                    </button>
                </div>
            </div>
            @elseif($peminjaman->status === 'disetujui' && !$peminjaman->pengembalian)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Catat Pengembalian</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('petugas.pengembalian.create', $peminjaman->id) }}" class="btn btn-primary">
                        <i class="bi bi-arrow-up-circle"></i> Catat Pengembalian
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('petugas.peminjaman.reject', $peminjaman->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Alasan Penolakan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection
