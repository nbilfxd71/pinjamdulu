@extends('layouts.app')

@section('title', 'Catat Pengembalian - Petugas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Catat Pengembalian</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Peminjam:</strong><br>
                            {{ $peminjaman->user->name }}<br>
                            <small class="text-muted">{{ $peminjaman->user->email }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong>Alat:</strong><br>
                            {{ $peminjaman->alat->nama }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Jumlah:</strong><br>
                            {{ $peminjaman->jumlah }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tgl Peminjaman:</strong><br>
                            {{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Data Pengembalian</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('petugas.pengembalian.store', $peminjaman->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', now()->format('Y-m-d')) }}" required>
                            @error('tanggal_pengembalian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="kondisi_alat" class="form-label">Kondisi Alat</label>
                            <select class="form-control @error('kondisi_alat') is-invalid @enderror" id="kondisi_alat" name="kondisi_alat" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baik" @if(old('kondisi_alat') === 'baik') selected @endif>Baik</option>
                                <option value="cacat" @if(old('kondisi_alat') === 'cacat') selected @endif>Cacat</option>
                                <option value="hilang" @if(old('kondisi_alat') === 'hilang') selected @endif>Hilang</option>
                            </select>
                            @error('kondisi_alat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="denda" class="form-label">Denda (Rp)</label>
                            <input type="number" class="form-control @error('denda') is-invalid @enderror" id="denda" name="denda" value="{{ old('denda', 0) }}" min="0" step="0.01">
                            @error('denda')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan">{{ old('catatan') }}</textarea>
                            @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
