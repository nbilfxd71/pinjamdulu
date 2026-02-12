<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tanggal_pengembalian' => 'required|date',
            'kondisi_alat' => 'required|in:baik,cacat,hilang',
            'catatan' => 'nullable|string',
            'denda' => 'nullable|numeric|min:0',
        ]);

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'kondisi_alat' => $validated['kondisi_alat'],
            'catatan' => $validated['catatan'] ?? null,
            'denda' => $validated['denda'] ?? 0,
        ]);

        $peminjaman->update(['status' => 'dikembalikan']);

        // Restore stok alat
        $peminjaman->alat->increment('stok_tersedia', $peminjaman->jumlah);

        return redirect('/petugas/pengembalian')->with('success', 'Pengembalian berhasil dicatat');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.user', 'peminjaman.alat']);
        return view('petugas.pengembalian.show', compact('pengembalian'));
    }
}
