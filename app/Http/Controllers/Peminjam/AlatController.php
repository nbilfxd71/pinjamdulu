<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')
            ->where('stok_tersedia', '>', 0)
            ->paginate(12);
        return view('peminjam.alats.index', compact('alats'));
    }

    public function show(Alat $alat)
    {
        return view('peminjam.alats.show', compact('alat'));
    }
}
