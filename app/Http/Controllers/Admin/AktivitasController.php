<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index()
    {
        $aktivitas = AktivitasLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.aktivitas.index', compact('aktivitas'));
    }

    public function show(AktivitasLog $aktivitasLog)
    {
        return view('admin.aktivitas.show', compact('aktivitasLog'));
    }
}
