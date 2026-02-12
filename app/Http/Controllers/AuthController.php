<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nomor_identitas' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'peminjam',
            'nomor_identitas' => $validated['nomor_identitas'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silahkan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah berhasil logout');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect('/petugas/dashboard');
        } else {
            return redirect('/peminjam/dashboard');
        }
    }
}
