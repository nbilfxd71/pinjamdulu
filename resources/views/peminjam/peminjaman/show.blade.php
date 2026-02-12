@extends('layouts.app')

@section('title', 'Detail Peminjaman - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">📄 Detail Peminjaman</h1>
        <a href="{{ route('peminjam.peminjaman.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Informasi Peminjaman -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Nama Alat</small></label>
                            <h6 class="fw-bold" style="color: #0066cc;">{{ $peminjaman->alat->nama }}</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Status Peminjaman</small></label>
                            @if($peminjaman->status === 'pending')
                                <h6><span class="badge bg-warning">⏳ Pending</span></h6>
                            @elseif($peminjaman->status === 'disetujui')
                                <h6><span class="badge bg-success">✓ Disetujui</span></h6>
                            @elseif($peminjaman->status === 'ditolak')
                                <h6><span class="badge bg-danger">✕ Ditolak</span></h6>
                            @else
                                <h6><span class="badge bg-info">↩ Dikembalikan</span></h6>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Jumlah</small></label>
                            <h6><span class="badge bg-light text-dark" style="font-size: 1rem;">{{ $peminjaman->jumlah }}</span></h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Tanggal Peminjaman</small></label>
                            <h6 class="fw-bold">{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Tanggal Kembali Rencana</small></label>
                            <h6 class="fw-bold">{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Messages -->
            @if($peminjaman->keterangan && $peminjaman->status === 'ditolak')
            <div class="alert alert-danger">
                <h6 class="fw-bold"><i class="bi bi-x-circle"></i> Alasan Penolakan</h6>
                <p class="mb-0">{{ $peminjaman->keterangan }}</p>
            </div>
            @endif

            @if($peminjaman->pengembalian)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-arrow-up-circle"></i> Informasi Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Tanggal Pengembalian</small></label>
                            <h6 class="fw-bold">{{ $peminjaman->pengembalian->tanggal_pengembalian->format('d-m-Y') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Kondisi Alat</small></label>
                            @if($peminjaman->pengembalian->kondisi_alat === 'baik')
                                <h6><span class="badge bg-success">✓ Baik</span></h6>
                            @elseif($peminjaman->pengembalian->kondisi_alat === 'cacat')
                                <h6><span class="badge bg-warning">Cacat</span></h6>
                            @else
                                <h6><span class="badge bg-danger">Hilang</span></h6>
                            @endif
                        </div>
                    </div>

                    @if($peminjaman->pengembalian->denda > 0)
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Denda</small></label>
                            <h6 class="fw-bold text-danger">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @elseif($peminjaman->status === 'disetujui')
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Alat sedang dalam peminjaman. Silakan kembalikan sesuai tanggal yang disepakati.
            </div>
            @endif

            <!-- Return Button -->
            @if($peminjaman->status === 'disetujui' && !$peminjaman->pengembalian)
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('peminjam.pengembalian.create', $peminjaman->id) }}" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-up-circle"></i> Kembalikan Alat Sekarang
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Timeline Info -->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-timeline"></i> Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker" style="background-color: #0066cc;"></div>
                            <div class="timeline-content">
                                <h6>Peminjaman Diajukan</h6>
                                <small class="text-muted">{{ $peminjaman->created_at->format('d-m-Y H:i') }}</small>
                            </div>
                        </div>

                        @if($peminjaman->status === 'disetujui' || $peminjaman->status === 'ditolak')
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker" style="background-color: @if($peminjaman->status === 'disetujui') #43e97b @else #f5576c @endif;"></div>
                            <div class="timeline-content">
                                <h6>@if($peminjaman->status === 'disetujui') Disetujui @else Ditolak @endif</h6>
                                <small class="text-muted">{{ $peminjaman->updated_at->format('d-m-Y H:i') }}</small>
                            </div>
                        </div>
                        @endif

                        @if($peminjaman->pengembalian)
                        <div class="timeline-item">
                            <div class="timeline-marker" style="background-color: #4facfe;"></div>
                            <div class="timeline-content">
                                <h6>Dikembalikan</h6>
                                <small class="text-muted">{{ $peminjaman->pengembalian->tanggal_pengembalian->format('d-m-Y H:i') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <style>
                .timeline-item { display: flex; padding-left: 30px; position: relative; }
                .timeline-marker { width: 12px; height: 12px; border-radius: 50%; position: absolute; left: 0; top: 4px; }
                .timeline-content { flex-grow: 1; }
            </style>
        </div>
    </div>
</div>
@endsection
