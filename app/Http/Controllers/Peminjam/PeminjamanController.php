<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PeminjamanController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', auth()->id())
            ->with(['alat', 'pengembalian'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create(Alat $alat)
    {
        return view('peminjam.peminjaman.create', compact('alat'));
    }

    public function store(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $alat->stok_tersedia,
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_peminjaman',
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'jumlah' => $validated['jumlah'],
            'tanggal_peminjaman' => $validated['tanggal_peminjaman'],
            'tanggal_kembali_rencana' => $validated['tanggal_kembali_rencana'],
            'status' => 'pending',
        ]);

        return redirect('/peminjam/peminjaman')->with('success', 'Permintaan peminjaman berhasil diajukan');
    }

    public function show(Peminjaman $peminjaman)
    {
        $this->authorize('view', $peminjaman);
        $peminjaman->load(['alat', 'pengembalian']);
        return view('peminjam.peminjaman.show', compact('peminjaman'));
    }
}
