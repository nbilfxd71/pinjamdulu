<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'alat', 'pengembalian']);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'disetujui']);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'APPROVE',
            'entitas' => 'Peminjaman',
            'entitas_id' => $peminjaman->id,
            'detail' => "Menyetujui peminjaman ID: {$peminjaman->id}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman disetujui');
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

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'REJECT',
            'entitas' => 'Peminjaman',
            'entitas_id' => $peminjaman->id,
            'detail' => "Menolak peminjaman ID: {$peminjaman->id}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman ditolak');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'DELETE',
            'entitas' => 'Peminjaman',
            'entitas_id' => $peminjaman->id,
            'detail' => "Menghapus peminjaman ID: {$peminjaman->id}",
            'ip_address' => request()->ip(),
        ]);

        $peminjaman->delete();
        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil dihapus');
    }
}
