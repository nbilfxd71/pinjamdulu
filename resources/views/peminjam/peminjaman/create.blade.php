@extends('layouts.app')

@section('title', 'Ajukan Peminjaman - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">📝 Ajukan Peminjaman</h1>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Detail Alat -->
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

                    @if($alat->deskripsi)
                    <div class="mb-3">
                        <label class="text-muted"><small>Deskripsi</small></label>
                        <p class="text-justify">{{ $alat->deskripsi }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Form Peminjaman -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Data Peminjaman</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('peminjam.peminjaman.store', $alat->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="jumlah" class="form-label"><i class="bi bi-hash"></i> Jumlah yang Ingin Dipinjam <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" max="{{ $alat->stok_tersedia }}" required>
                            <small class="text-muted">Maksimal: {{ $alat->stok_tersedia }} unit</small>
                            @error('jumlah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_peminjaman" class="form-label"><i class="bi bi-calendar"></i> Tanggal Peminjaman <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                            @error('tanggal_peminjaman')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kembali_rencana" class="form-label"><i class="bi bi-calendar-check"></i> Tanggal Kembali Rencana <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_kembali_rencana') is-invalid @enderror" id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" value="{{ old('tanggal_kembali_rencana') }}" required>
                            @error('tanggal_kembali_rencana')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" style="padding: 10px; font-weight: 600;">
                                <i class="bi bi-send"></i> Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card" style="background: #0066cc; color: white; border: none;">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-lightbulb"></i> Panduan Peminjaman</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Tentukan jumlah alat yang ingin dipinjam</li>
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Pilih tanggal peminjaman dan kembali</li>
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Tunggu persetujuan dari petugas</li>
                        <li class="mb-2"><i class="bi bi-check-circle"></i> Kembalikan alat sesuai jadwal</li>
                    </ul>
                </div>
            </div>

            <div class="alert alert-warning mt-3">
                <strong><i class="bi bi-exclamation-triangle"></i> Catatan Penting</strong>
                <p class="mb-0 mt-2 small">Harap kembalikan alat sesuai dengan tanggal yang telah disepakati untuk menghindari denda keterlambatan.</p>
            </div>
        </div>
    </div>

    <a href="{{ route('peminjam.alats.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection
