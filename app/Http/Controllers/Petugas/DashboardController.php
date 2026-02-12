<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjamanPending = Peminjaman::where('status', 'pending')->count();
        $peminjamanDisetujui = Peminjaman::where('status', 'disetujui')->count();
        $peminjamanBelumDikembalikan = Peminjaman::where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->count();
        $pengembalianHariIni = Pengembalian::whereDate('created_at', today())->count();

        $recentPeminjamans = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('petugas.dashboard', compact(
            'peminjamanPending',
            'peminjamanDisetujui',
            'peminjamanBelumDikembalikan',
            'pengembalianHariIni',
            'recentPeminjamans'
        ));
    }
}
