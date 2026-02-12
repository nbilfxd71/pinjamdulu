@extends('layouts.app')

@section('title', 'Edit Alat - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Alat</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.alats.update', $alat->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Alat</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $alat->nama) }}" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @if(old('kategori_id', $alat->kategori_id) == $kategori->id) selected @endif>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $alat->stok) }}" min="1" required>
                            @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_seri" class="form-label">Nomor Seri</label>
                            <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror" id="nomor_seri" name="nomor_seri" value="{{ old('nomor_seri', $alat->nomor_seri) }}">
                            @error('nomor_seri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-control @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required>
                                <option value="baik" @if(old('kondisi', $alat->kondisi) === 'baik') selected @endif>Baik</option>
                                <option value="rusak" @if(old('kondisi', $alat->kondisi) === 'rusak') selected @endif>Rusak</option>
                                <option value="perbaikan" @if(old('kondisi', $alat->kondisi) === 'perbaikan') selected @endif>Perbaikan</option>
                            </select>
                            @error('kondisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">
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
