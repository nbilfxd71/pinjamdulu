@extends('layouts.app')

@section('title', 'Edit Pengembalian - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Pengembalian</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pengembalian.update', $pengembalian->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian->format('Y-m-d')) }}" required>
                            @error('tanggal_pengembalian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="kondisi_alat" class="form-label">Kondisi Alat</label>
                            <select class="form-control @error('kondisi_alat') is-invalid @enderror" id="kondisi_alat" name="kondisi_alat" required>
                                <option value="baik" @if(old('kondisi_alat', $pengembalian->kondisi_alat) === 'baik') selected @endif>Baik</option>
                                <option value="cacat" @if(old('kondisi_alat', $pengembalian->kondisi_alat) === 'cacat') selected @endif>Cacat</option>
                                <option value="hilang" @if(old('kondisi_alat', $pengembalian->kondisi_alat) === 'hilang') selected @endif>Hilang</option>
                            </select>
                            @error('kondisi_alat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="denda" class="form-label">Denda (Rp)</label>
                            <input type="number" class="form-control @error('denda') is-invalid @enderror" id="denda" name="denda" value="{{ old('denda', $pengembalian->denda) }}" min="0" step="0.01">
                            @error('denda')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan">{{ old('catatan', $pengembalian->catatan) }}</textarea>
                            @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
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
