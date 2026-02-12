@extends('layouts.app')

@section('title', 'Daftar Alats - Peminjam')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="mb-0" style="font-weight: 700; color: #2d3748;">🔧 Daftar Alat Tersedia</h1>
        <a href="{{ route('peminjam.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if($alats->count())
        <div class="row g-4">
            @foreach($alats as $alat)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm" style="transition: all 0.3s ease; border: none;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="color: #0066cc; font-weight: 600;">{{ $alat->nama }}</h5>
                            <p class="text-muted mb-3"><small><i class="bi bi-folder"></i> {{ $alat->kategori->nama }}</small></p>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($alat->deskripsi, 100) }}</p>
                            
                            <div class="mb-3 pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Stok Tersedia:</span>
                                    <span class="badge bg-info" style="font-size: 1rem;">{{ $alat->stok_tersedia }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Kondisi:</span>
                                    @if($alat->kondisi === 'baik')
                                        <span class="badge bg-success">✓ Baik</span>
                                    @elseif($alat->kondisi === 'rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                    @else
                                        <span class="badge bg-warning">Perbaikan</span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($alat->stok_tersedia > 0)
                                <div class="d-grid gap-2 mt-auto">
                                    <a href="{{ route('peminjam.peminjaman.create', $alat->id) }}" class="btn btn-primary">
                                        <i class="bi bi-hand-thumbs-up"></i> Ajukan Peminjaman
                                    </a>
                                    <a href="{{ route('peminjam.alats.show', $alat->id) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </div>
                            @else
                                <button class="btn btn-secondary w-100 mt-auto" disabled>
                                    <i class="bi bi-lock"></i> Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $alats->links() }}
        </div>
    @else
        <div class="alert alert-info text-center py-5" style="border-radius: 8px;">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #0066cc;"></i>
            <h4 class="mt-3">Tidak ada alat tersedia</h4>
            <p class="text-muted">Silakan periksa kembali nanti</p>
        </div>
    @endif
</div>
@endsection
