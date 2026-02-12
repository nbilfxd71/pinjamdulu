<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'peminjam')->count();
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanPending = Peminjaman::where('status', 'pending')->count();
        $peminjamanDisetujui = Peminjaman::where('status', 'disetujui')->count();
        $peminjamanDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        $recentAktivitas = AktivitasLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAlat',
            'totalPeminjaman',
            'peminjamanPending',
            'peminjamanDisetujui',
            'peminjamanDikembalikan',
            'recentAktivitas'
        ));
    }
}
