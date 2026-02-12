<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->paginate(10);
        return view('admin.alats.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alats.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:1',
            'nomor_seri' => 'nullable|string|max:255',
            'kondisi' => 'required|in:baik,rusak,perbaikan',
        ]);

        $validated['stok_tersedia'] = $validated['stok'];

        $alat = Alat::create($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'CREATE',
            'entitas' => 'Alat',
            'entitas_id' => $alat->id,
            'detail' => "Membuat alat baru: {$alat->nama}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/alats')->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alats.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:1',
            'nomor_seri' => 'nullable|string|max:255',
            'kondisi' => 'required|in:baik,rusak,perbaikan',
        ]);

        $alat->update($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'UPDATE',
            'entitas' => 'Alat',
            'entitas_id' => $alat->id,
            'detail' => "Mengupdate alat: {$alat->nama}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/alats')->with('success', 'Alat berhasil diupdate');
    }

    public function destroy(Alat $alat)
    {
        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'DELETE',
            'entitas' => 'Alat',
            'entitas_id' => $alat->id,
            'detail' => "Menghapus alat: {$alat->nama}",
            'ip_address' => request()->ip(),
        ]);

        $alat->delete();
        return redirect('/admin/alats')->with('success', 'Alat berhasil dihapus');
    }
}
