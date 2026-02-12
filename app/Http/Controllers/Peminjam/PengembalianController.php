<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->with('alat')
            ->paginate(10);
        return view('peminjam.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        $this->authorize('view', $peminjaman);
        return view('peminjam.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $this->authorize('view', $peminjaman);

        $validated = $request->validate([
            'kondisi_alat' => 'required|in:baik,cacat,hilang',
            'catatan' => 'nullable|string',
        ]);

        $pengembalian = $peminjaman->pengembalian()->create([
            'tanggal_pengembalian' => now()->toDateString(),
            'kondisi_alat' => $validated['kondisi_alat'],
            'catatan' => $validated['catatan'] ?? null,
            'denda' => 0,
        ]);

        $peminjaman->update(['status' => 'dikembalikan']);

        return redirect('/peminjam/dashboard')->with('success', 'Alat berhasil dikembalikan');
    }
}
