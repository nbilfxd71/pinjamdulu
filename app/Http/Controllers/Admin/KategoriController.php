<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::paginate(10);
        return view('admin.kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategoris.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::create($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'CREATE',
            'entitas' => 'Kategori',
            'entitas_id' => $kategori->id,
            'detail' => "Membuat kategori baru: {$kategori->nama}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/kategoris')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'UPDATE',
            'entitas' => 'Kategori',
            'entitas_id' => $kategori->id,
            'detail' => "Mengupdate kategori: {$kategori->nama}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/kategoris')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'DELETE',
            'entitas' => 'Kategori',
            'entitas_id' => $kategori->id,
            'detail' => "Menghapus kategori: {$kategori->nama}",
            'ip_address' => request()->ip(),
        ]);

        $kategori->delete();
        return redirect('/admin/kategoris')->with('success', 'Kategori berhasil dihapus');
    }
}
