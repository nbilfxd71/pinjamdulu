<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController as AdminAlatController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;
use App\Http\Controllers\Admin\AktivitasController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboardController;
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\PengembalianController as PeminjamPengembalianController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Users
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Kategoris
        Route::get('/admin/kategoris', [KategoriController::class, 'index'])->name('admin.kategoris.index');
        Route::get('/admin/kategoris/create', [KategoriController::class, 'create'])->name('admin.kategoris.create');
        Route::post('/admin/kategoris', [KategoriController::class, 'store'])->name('admin.kategoris.store');
        Route::get('/admin/kategoris/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategoris.edit');
        Route::put('/admin/kategoris/{kategori}', [KategoriController::class, 'update'])->name('admin.kategoris.update');
        Route::delete('/admin/kategoris/{kategori}', [KategoriController::class, 'destroy'])->name('admin.kategoris.destroy');

        // Alats
        Route::get('/admin/alats', [AdminAlatController::class, 'index'])->name('admin.alats.index');
        Route::get('/admin/alats/create', [AdminAlatController::class, 'create'])->name('admin.alats.create');
        Route::post('/admin/alats', [AdminAlatController::class, 'store'])->name('admin.alats.store');
        Route::get('/admin/alats/{alat}/edit', [AdminAlatController::class, 'edit'])->name('admin.alats.edit');
        Route::put('/admin/alats/{alat}', [AdminAlatController::class, 'update'])->name('admin.alats.update');
        Route::delete('/admin/alats/{alat}', [AdminAlatController::class, 'destroy'])->name('admin.alats.destroy');

        // Peminjaman
        Route::get('/admin/peminjaman', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
        Route::get('/admin/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'show'])->name('admin.peminjaman.show');
        Route::post('/admin/peminjaman/{peminjaman}/approve', [AdminPeminjamanController::class, 'approve'])->name('admin.peminjaman.approve');
        Route::post('/admin/peminjaman/{peminjaman}/reject', [AdminPeminjamanController::class, 'reject'])->name('admin.peminjaman.reject');
        Route::delete('/admin/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');

        // Pengembalian
        Route::get('/admin/pengembalian', [AdminPengembalianController::class, 'index'])->name('admin.pengembalian.index');
        Route::get('/admin/pengembalian/{peminjaman}/create', [AdminPengembalianController::class, 'create'])->name('admin.pengembalian.create');
        Route::post('/admin/pengembalian/{peminjaman}', [AdminPengembalianController::class, 'store'])->name('admin.pengembalian.store');
        Route::get('/admin/pengembalian/{pengembalian}', [AdminPengembalianController::class, 'show'])->name('admin.pengembalian.show');
        Route::get('/admin/pengembalian/{pengembalian}/edit', [AdminPengembalianController::class, 'edit'])->name('admin.pengembalian.edit');
        Route::put('/admin/pengembalian/{pengembalian}', [AdminPengembalianController::class, 'update'])->name('admin.pengembalian.update');
        Route::delete('/admin/pengembalian/{pengembalian}', [AdminPengembalianController::class, 'destroy'])->name('admin.pengembalian.destroy');

        // Aktivitas
        Route::get('/admin/aktivitas', [AktivitasController::class, 'index'])->name('admin.aktivitas.index');
        Route::get('/admin/aktivitas/{aktivitasLog}', [AktivitasController::class, 'show'])->name('admin.aktivitas.show');
    });

    // Petugas routes
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        // Peminjaman
        Route::get('/petugas/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('petugas.peminjaman.index');
        Route::get('/petugas/peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'show'])->name('petugas.peminjaman.show');
        Route::post('/petugas/peminjaman/{peminjaman}/approve', [PetugasPeminjamanController::class, 'approve'])->name('petugas.peminjaman.approve');
        Route::post('/petugas/peminjaman/{peminjaman}/reject', [PetugasPeminjamanController::class, 'reject'])->name('petugas.peminjaman.reject');

        // Pengembalian
        Route::get('/petugas/pengembalian', [PetugasPengembalianController::class, 'index'])->name('petugas.pengembalian.index');
        Route::get('/petugas/pengembalian/{peminjaman}/create', [PetugasPengembalianController::class, 'create'])->name('petugas.pengembalian.create');
        Route::post('/petugas/pengembalian/{peminjaman}', [PetugasPengembalianController::class, 'store'])->name('petugas.pengembalian.store');
        Route::get('/petugas/pengembalian/{pengembalian}', [PetugasPengembalianController::class, 'show'])->name('petugas.pengembalian.show');

        // Laporan
        Route::get('/petugas/laporan', [LaporanController::class, 'index'])->name('petugas.laporan.index');
        Route::get('/petugas/laporan/print', [LaporanController::class, 'print'])->name('petugas.laporan.print');
    });

    // Peminjam routes
    Route::middleware('role:peminjam')->group(function () {
        Route::get('/peminjam/dashboard', [PeminjamDashboardController::class, 'index'])->name('peminjam.dashboard');

        // Alats
        Route::get('/peminjam/alats', [PeminjamAlatController::class, 'index'])->name('peminjam.alats.index');
        Route::get('/peminjam/alats/{alat}', [PeminjamAlatController::class, 'show'])->name('peminjam.alats.show');

        // Peminjaman
        Route::get('/peminjam/peminjaman', [PeminjamPeminjamanController::class, 'index'])->name('peminjam.peminjaman.index');
        Route::get('/peminjam/peminjaman/{alat}/create', [PeminjamPeminjamanController::class, 'create'])->name('peminjam.peminjaman.create');
        Route::post('/peminjam/peminjaman/{alat}', [PeminjamPeminjamanController::class, 'store'])->name('peminjam.peminjaman.store');
        Route::get('/peminjam/peminjaman/{peminjaman}', [PeminjamPeminjamanController::class, 'show'])->name('peminjam.peminjaman.show');

        // Pengembalian
        Route::get('/peminjam/pengembalian', [PeminjamPengembalianController::class, 'index'])->name('peminjam.pengembalian.index');
        Route::get('/peminjam/pengembalian/{peminjaman}/create', [PeminjamPengembalianController::class, 'create'])->name('peminjam.pengembalian.create');
        Route::post('/peminjam/pengembalian/{peminjaman}', [PeminjamPengembalianController::class, 'store'])->name('peminjam.pengembalian.store');
    });
});
