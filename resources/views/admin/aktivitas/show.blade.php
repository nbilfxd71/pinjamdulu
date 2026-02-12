@extends('layouts.app')

@section('title', 'Detail Aktivitas - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Detail Aktivitas</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Aktivitas</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>User:</strong><br>
                            {{ $aktivitasLog->user->name }} ({{ $aktivitasLog->user->email }})
                        </div>
                        <div class="col-md-6">
                            <strong>Waktu:</strong><br>
                            {{ $aktivitasLog->created_at->format('d-m-Y H:i:s') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Aksi:</strong><br>
                            <span class="badge bg-info">{{ $aktivitasLog->aksi }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Entitas:</strong><br>
                            {{ $aktivitasLog->entitas }} #{{ $aktivitasLog->entitas_id }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>IP Address:</strong><br>
                            {{ $aktivitasLog->ip_address }}
                        </div>
                    </div>

                    @if($aktivitasLog->detail)
                    <div class="mb-3">
                        <strong>Detail:</strong><br>
                        <p class="bg-light p-3 rounded">{{ $aktivitasLog->detail }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <a href="{{ route('admin.aktivitas.index') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
