@extends('layouts.app')

@section('title', 'Detail Pengembalian - Petugas')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Detail Pengembalian</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Peminjam:</strong><br>
                            {{ $pengembalian->peminjaman->user->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Alat:</strong><br>
                            {{ $pengembalian->peminjaman->alat->nama }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Peminjaman:</strong><br>
                            {{ $pengembalian->peminjaman->tanggal_peminjaman->format('d-m-Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Kembali Rencana:</strong><br>
                            {{ $pengembalian->peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Pengembalian Aktual:</strong><br>
                            {{ $pengembalian->tanggal_pengembalian->format('d-m-Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Kondisi Alat:</strong><br>
                            @if($pengembalian->kondisi_alat === 'baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($pengembalian->kondisi_alat === 'cacat')
                                <span class="badge bg-warning">Cacat</span>
                            @else
                                <span class="badge bg-danger">Hilang</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Denda:</strong><br>
                            @if($pengembalian->denda > 0)
                                Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                            @else
                                Tidak ada denda
                            @endif
                        </div>
                    </div>

                    @if($pengembalian->catatan)
                    <div class="mb-3">
                        <strong>Catatan:</strong><br>
                        {{ $pengembalian->catatan }}
                    </div>
                    @endif
                </div>
            </div>

            <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
