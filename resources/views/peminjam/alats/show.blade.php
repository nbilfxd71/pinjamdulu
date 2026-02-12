@extends('layouts.app')

@section('title', 'Detail Alat - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">🔧 {{ $alat->nama }}</h1>
        <a href="{{ route('peminjam.alats.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Informasi Alat -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Alat</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Nama Alat</small></label>
                            <h6 class="fw-bold" style="color: #0066cc;">{{ $alat->nama }}</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Kategori</small></label>
                            <h6 class="fw-bold">{{ $alat->kategori->nama }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Stok Tersedia</small></label>
                            <h6><span class="badge bg-info" style="font-size: 1rem;">{{ $alat->stok_tersedia }}</span></h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Kondisi Alat</small></label>
                            @if($alat->kondisi === 'baik')
                                <h6><span class="badge bg-success">✓ Baik</span></h6>
                            @elseif($alat->kondisi === 'rusak')
                                <h6><span class="badge bg-danger">Rusak</span></h6>
                            @else
                                <h6><span class="badge bg-warning">Perbaikan</span></h6>
                            @endif
                        </div>
                    </div>

                    @if($alat->nomor_seri)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Nomor Seri</small></label>
                            <h6 class="fw-bold">{{ $alat->nomor_seri }}</h6>
                        </div>
                    </div>
                    @endif

                    @if($alat->deskripsi)
                    <div class="mb-3">
                        <label class="text-muted"><small>Deskripsi</small></label>
                        <p class="text-justify">{{ $alat->deskripsi }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                @if($alat->stok_tersedia > 0)
                    <a href="{{ route('peminjam.peminjaman.create', $alat->id) }}" class="btn btn-primary btn-lg flex-grow-1">
                        <i class="bi bi-hand-thumbs-up"></i> Ajukan Peminjaman
                    </a>
                @else
                    <button class="btn btn-secondary btn-lg flex-grow-1" disabled>
                        <i class="bi bi-lock"></i> Stok Habis
                    </button>
                @endif
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-12 col-lg-4">
            <div class="card" style="background: #0066cc; color: white; border: none;">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-lightbulb"></i> Panduan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Periksa stok alat tersedia</li>
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Baca deskripsi dengan teliti</li>
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Ajukan peminjaman jika cocok</li>
                        <li><i class="bi bi-check-circle"></i> Tunggu persetujuan petugas</li>
                    </ul>
                </div>
            </div>

            @if($alat->stok_tersedia > 0)
            <div class="alert alert-success mt-3">
                <i class="bi bi-check-circle"></i> Alat ini <strong>tersedia</strong> untuk dipinjam
            </div>
            @else
            <div class="alert alert-warning mt-3">
                <i class="bi bi-exclamation-circle"></i> Alat ini saat ini <strong>tidak tersedia</strong>, silakan cek lagi nanti
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
