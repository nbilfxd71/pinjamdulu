@extends('layouts.app')

@section('title', 'Log Aktivitas - Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Log Aktivitas</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Entitas</th>
                            <th>Detail</th>
                            <th>IP Address</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aktivitas as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td><span class="badge bg-info">{{ $log->aksi }}</span></td>
                                <td>{{ $log->entitas }}</td>
                                <td>{{ Str::limit($log->detail, 50) }}</td>
                                <td><small>{{ $log->ip_address }}</small></td>
                                <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.aktivitas.show', $log->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $aktivitas->links() }}
        </div>
    </div>
</div>
@endsection
