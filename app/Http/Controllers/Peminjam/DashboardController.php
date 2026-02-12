<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', auth()->id())
            ->with('alat')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPeminjaman = $peminjamans->count();
        $peminjamanAktif = $peminjamans->where('status', 'disetujui')->count();
        $peminjamanPending = $peminjamans->where('status', 'pending')->count();
        $peminjamanDikembalikan = $peminjamans->where('status', 'dikembalikan')->count();

        return view('peminjam.dashboard', compact(
            'totalPeminjaman',
            'peminjamanAktif',
            'peminjamanPending',
            'peminjamanDikembalikan',
            'peminjamans'
        ));
    }
}
