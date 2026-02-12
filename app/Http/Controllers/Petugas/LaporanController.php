<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat', 'pengembalian'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPeminjaman = $peminjamans->count();
        $totalPengembalian = $peminjamans->where('status', 'dikembalikan')->count();
        $totalDenda = Pengembalian::sum('denda');

        return view('petugas.laporan.index', compact(
            'peminjamans',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDenda'
        ));
    }

    public function print()
    {
        $peminjamans = Peminjaman::with(['user', 'alat', 'pengembalian'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPeminjaman = $peminjamans->count();
        $totalPengembalian = $peminjamans->where('status', 'dikembalikan')->count();
        $totalDenda = Pengembalian::sum('denda');

        return view('petugas.laporan.print', compact(
            'peminjamans',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDenda'
        ));
    }
}
