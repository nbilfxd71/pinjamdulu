<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pinjamdulu')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #2d3748;
            min-height: 100vh;
            padding: 20px 15px;
            position: fixed;
            width: 260px;
            left: 0;
            top: 0;
            box-shadow: 1px 0 3px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 999;
        }
        .sidebar h5 {
            color: #0066cc;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 30px;
            padding: 0 10px;
        }
        .sidebar a {
            color: #cbd5e0;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            font-size: 0.95rem;
        }
        .sidebar a:hover {
            background-color: rgba(0, 102, 204, 0.15);
            color: #0066cc;
            padding-left: 20px;
        }
        .sidebar a.active {
            background-color: #0066cc;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 102, 204, 0.3);
        }
        .sidebar i {
            font-size: 1.1rem;
            min-width: 20px;
        }
        .main-content {
            padding: 30px;
            margin-left: 260px;
            margin-top: 70px;
        }
        .navbar {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #e2e8f0;
            margin-left: 260px;
        }
        .navbar-brand {
            font-weight: 700;
            color: #2d3748 !important;
            font-size: 1.2rem;
        }
        .navbar-text {
            color: #2d3748 !important;
            font-weight: 500;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 20px;
            font-weight: 600;
        }
        .card-body {
            padding: 20px;
        }
        .stat-card {
            background-color: #0066cc;
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2);
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            box-shadow: 0 1px 3px rgba(0, 102, 204, 0.3);
        }
        .stat-card h6 {
            font-size: 13px;
            margin-bottom: 10px;
            opacity: 0.95;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        .alert {
            border: none;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .btn {
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
        }
        .btn-primary {
            background-color: #0066cc;
            box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2);
        }
        .btn-primary:hover {
            background-color: #0052a3;
            box-shadow: 0 1px 3px rgba(0, 102, 204, 0.3);
            color: white;
        }
        .btn-danger {
            background-color: #e74c3c;
            box-shadow: 0 1px 3px rgba(231, 76, 60, 0.2);
        }
        .btn-danger:hover {
            background-color: #c0392b;
            box-shadow: 0 1px 3px rgba(231, 76, 60, 0.3);
            color: white;
        }
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        @media (max-width: 992px) {
            .sidebar {
                width: 220px;
            }
            .main-content {
                margin-left: 220px;
                padding: 25px;
            }
            .navbar {
                margin-left: 220px;
            }
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                padding: 15px;
            }
            .sidebar h5 {
                font-size: 1rem;
                margin-bottom: 15px;
            }
            .sidebar a {
                padding: 10px 12px;
                margin: 3px 0;
                font-size: 0.9rem;
            }
            .main-content {
                padding: 20px;
                margin-left: 0;
                margin-top: 0;
            }
            .navbar {
                position: relative;
                margin-left: 0;
            }
            .stat-card {
                margin-bottom: 15px;
            }
            .col-md-3,
            .col-md-6,
            .col-md-12 {
                margin-bottom: 15px;
            }
        }
        @media (max-width: 576px) {
            .sidebar a {
                padding: 8px 10px;
                font-size: 0.85rem;
            }
            .main-content {
                padding: 15px;
            }
            .card {
                margin-bottom: 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar untuk Admin dan Petugas -->
    @auth
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
            <div class="sidebar">
                <h5 class="text-white">
                    <i class="bi bi-tools"></i> Pinjamdulu
                </h5>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="@if(request()->is('admin/dashboard')) active @endif">
                        <i class="bi bi-graph-up"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="@if(request()->is('admin/users*')) active @endif">
                        <i class="bi bi-people"></i> Users
                    </a>
                    <a href="{{ route('admin.alats.index') }}" class="@if(request()->is('admin/alats*')) active @endif">
                        <i class="bi bi-box"></i> Alat
                    </a>
                    <a href="{{ route('admin.kategoris.index') }}" class="@if(request()->is('admin/kategoris*')) active @endif">
                        <i class="bi bi-tag"></i> Kategoris
                    </a>
                    <a href="{{ route('admin.peminjaman.index') }}" class="@if(request()->is('admin/peminjaman*')) active @endif">
                        <i class="bi bi-hand-thumbs-up"></i> Peminjaman
                    </a>
                    <a href="{{ route('admin.pengembalian.index') }}" class="@if(request()->is('admin/pengembalian*')) active @endif">
                        <i class="bi bi-hand-thumbs-down"></i> Pengembalian
                    </a>
                    <a href="{{ route('admin.aktivitas.index') }}" class="@if(request()->is('admin/aktivitas*')) active @endif">
                        <i class="bi bi-clock-history"></i> Aktivitas
                    </a>
                @elseif(auth()->user()->role === 'petugas')
                    <a href="{{ route('petugas.dashboard') }}" class="@if(request()->is('petugas/dashboard')) active @endif">
                        <i class="bi bi-graph-up"></i> Dashboard
                    </a>
                    <a href="{{ route('petugas.peminjaman.index') }}" class="@if(request()->is('petugas/peminjaman*')) active @endif">
                        <i class="bi bi-hand-thumbs-up"></i> Peminjaman
                    </a>
                    <a href="{{ route('petugas.pengembalian.index') }}" class="@if(request()->is('petugas/pengembalian*')) active @endif">
                        <i class="bi bi-hand-thumbs-down"></i> Pengembalian
                    </a>
                    <a href="{{ route('petugas.laporan.index') }}" class="@if(request()->is('petugas/laporan*')) active @endif">
                        <i class="bi bi-file-earmark-pdf"></i> Laporan
                    </a>
                @endif
                <hr class="bg-light" style="margin: 20px 0;">
                <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit();" class="text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        @elseif(auth()->user()->role === 'peminjam')
            <!-- Sidebar untuk Peminjam -->
            <div class="sidebar">
                <h5 class="text-white">
                    <i class="bi bi-book"></i> Pinjamdulu
                </h5>
                <a href="{{ route('peminjam.dashboard') }}" class="@if(request()->is('peminjam/dashboard')) active @endif">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
                <a href="{{ route('peminjam.alats.index') }}" class="@if(request()->is('peminjam/alats*')) active @endif">
                    <i class="bi bi-box"></i> Daftar Alat
                </a>
                <a href="{{ route('peminjam.peminjaman.index') }}" class="@if(request()->is('peminjam/peminjaman*')) active @endif">
                    <i class="bi bi-hand-thumbs-up"></i> Peminjaman Saya
                </a>
                <a href="{{ route('peminjam.pengembalian.index') }}" class="@if(request()->is('peminjam/pengembalian*')) active @endif">
                    <i class="bi bi-arrow-up-circle"></i> Pengembalian
                </a>
                <hr class="bg-light" style="margin: 20px 0;">
                <div style="padding: 0 15px;">
                    <p class="text-muted mb-2" style="font-size: 0.85rem;">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </p>
                </div>
                <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit();" style="background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; border-radius: 8px; margin: 0 0 0 0;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        @endif
    @endauth

    <!-- Navbar -->
    @auth
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand">
                    <i class="bi bi-tools"></i> Pinjamdulu - 
                    @if(auth()->user()->role === 'admin')
                        Admin
                    @elseif(auth()->user()->role === 'petugas')
                        Petugas
                    @else
                        Peminjam
                    @endif
                </span>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <span class="navbar-text"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</span>
                    <a href="javascript:void(0)" onclick="document.getElementById('logoutForm2').submit();" class="btn btn-sm btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logoutForm2" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <!-- Main Content -->
    <div class="main-content">
        @if($errors->any())
            <div class="alert alert-danger">
                <h5>Error!</h5>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
