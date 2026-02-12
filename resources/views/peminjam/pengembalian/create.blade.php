@extends('layouts.app')

@section('title', 'Kembalikan Alat - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">↩️ Kembalikan Alat</h1>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Detail Peminjaman -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Nama Alat</small></label>
                            <h6 class="fw-bold" style="color: #0066cc;">{{ $peminjaman->alat->nama }}</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Jumlah</small></label>
                            <h6><span class="badge bg-light text-dark" style="font-size: 1rem;">{{ $peminjaman->jumlah }}</span></h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted"><small>Tanggal Peminjaman</small></label>
                            <h6 class="fw-bold">{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted"><small>Tanggal Kembali Rencana</small></label>
                            <h6 class="fw-bold">{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pengembalian -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Data Pengembalian</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('peminjam.pengembalian.store', $peminjaman->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="kondisi_alat" class="form-label"><i class="bi bi-box"></i> Kondisi Alat <span class="text-danger">*</span></label>
                            <select class="form-control @error('kondisi_alat') is-invalid @enderror" id="kondisi_alat" name="kondisi_alat" required>
                                <option value="">-- Pilih Kondisi Alat --</option>
                                <option value="baik" @if(old('kondisi_alat') === 'baik') selected @endif>✓ Baik (Tanpa Kerusakan)</option>
                                <option value="cacat" @if(old('kondisi_alat') === 'cacat') selected @endif>⚠ Cacat (Ada Kerusakan)</option>
                                <option value="hilang" @if(old('kondisi_alat') === 'hilang') selected @endif>✕ Hilang (Tidak Ditemukan)</option>
                            </select>
                            @error('kondisi_alat')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label"><i class="bi bi-chat"></i> Catatan/Keterangan (Opsional)</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="4" placeholder="Tuliskan catatan atau keterangan apapun...">{{ old('catatan') }}</textarea>
                            @error('catatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" style="padding: 10px; font-weight: 600;">
                                <i class="bi bi-send"></i> Konfirmasi Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card" style="background: #0066cc; color: white; border: none;">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-info-circle"></i> Petunjuk Pengembalian</h5>
                    <ol class="ps-3 mb-0">
                        <li class="mb-2">Periksa kondisi alat dengan teliti</li>
                        <li class="mb-2">Pilih kondisi yang sesuai</li>
                        <li class="mb-2">Tambahkan catatan jika ada kerusakan</li>
                        <li>Konfirmasi pengembalian</li>
                    </ol>
                </div>
            </div>

            <div class="alert alert-info mt-3">
                <strong><i class="bi bi-exclamation-circle"></i> Informasi Kondisi</strong>
                <ul class="mb-0 mt-2 small">
                    <li><strong>Baik:</strong> Alat dalam kondisi normal tanpa kerusakan</li>
                    <li><strong>Cacat:</strong> Ada kerusakan kecil yang tidak mempengaruhi fungsi utama</li>
                    <li><strong>Hilang:</strong> Alat tidak dapat ditemukan</li>
                </ul>
            </div>

            <div class="alert alert-warning mt-3">
                <strong><i class="bi bi-exclamation-triangle"></i> Perhatian</strong>
                <p class="mb-0 mt-2 small">Keterlambatan pengembalian atau kerusakan alat dapat dikenakan denda sesuai kebijakan institusi.</p>
            </div>
        </div>
    </div>

    <a href="{{ route('peminjam.pengembalian.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection
