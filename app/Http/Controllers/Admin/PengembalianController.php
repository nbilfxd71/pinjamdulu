<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])->paginate(10);
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('admin.pengembalian.create', compact('peminjaman'));
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

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'CREATE',
            'entitas' => 'Pengembalian',
            'entitas_id' => $pengembalian->id,
            'detail' => "Mencatat pengembalian untuk peminjaman ID: {$peminjaman->id}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/pengembalian')->with('success', 'Pengembalian berhasil dicatat');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.user', 'peminjaman.alat']);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        return view('admin.pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'tanggal_pengembalian' => 'required|date',
            'kondisi_alat' => 'required|in:baik,cacat,hilang',
            'catatan' => 'nullable|string',
            'denda' => 'nullable|numeric|min:0',
        ]);

        $pengembalian->update($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'UPDATE',
            'entitas' => 'Pengembalian',
            'entitas_id' => $pengembalian->id,
            'detail' => "Mengupdate pengembalian ID: {$pengembalian->id}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/pengembalian')->with('success', 'Pengembalian berhasil diupdate');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'DELETE',
            'entitas' => 'Pengembalian',
            'entitas_id' => $pengembalian->id,
            'detail' => "Menghapus pengembalian ID: {$pengembalian->id}",
            'ip_address' => request()->ip(),
        ]);

        $pengembalian->delete();
        return redirect('/admin/pengembalian')->with('success', 'Pengembalian berhasil dihapus');
    }
}
