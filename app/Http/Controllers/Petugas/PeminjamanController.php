<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'alat', 'pengembalian']);
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        $alat = $peminjaman->alat;
        
        if ($alat->stok_tersedia < $peminjaman->jumlah) {
            return back()->with('error', 'Stok alat tidak cukup');
        }

        $alat->decrement('stok_tersedia', $peminjaman->jumlah);
        $peminjaman->update(['status' => 'disetujui']);

        return redirect('/petugas/peminjaman')->with('success', 'Peminjaman disetujui');
    }

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string',
        ]);

        $peminjaman->update([
            'status' => 'ditolak',
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect('/petugas/peminjaman')->with('success', 'Peminjaman ditolak');
    }
}
