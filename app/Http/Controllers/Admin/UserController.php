<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AktivitasLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,petugas,peminjam',
            'nomor_identitas' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nomor_identitas' => $validated['nomor_identitas'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'CREATE',
            'entitas' => 'User',
            'entitas_id' => $user->id,
            'detail' => "Membuat user baru: {$user->name}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,petugas,peminjam',
            'nomor_identitas' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        $user->update($validated);

        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'UPDATE',
            'entitas' => 'User',
            'entitas_id' => $user->id,
            'detail' => "Mengupdate user: {$user->name}",
            'ip_address' => request()->ip(),
        ]);

        return redirect('/admin/users')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        AktivitasLog::create([
            'user_id' => auth()->id(),
            'aksi' => 'DELETE',
            'entitas' => 'User',
            'entitas_id' => $user->id,
            'detail' => "Menghapus user: {$user->name}",
            'ip_address' => request()->ip(),
        ]);

        $user->delete();
        return redirect('/admin/users')->with('success', 'User berhasil dihapus');
    }
}
