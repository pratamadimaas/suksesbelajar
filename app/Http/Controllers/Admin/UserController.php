<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna
     */
    public function index()
    {
        // Ambil semua pengguna dari database
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk menambah pengguna baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan pengguna baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Menetapkan role 'siswa' dengan ID 1
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Reset password user tertentu.
     * Kata sandi baru akan diatur ke 'password123' secara default.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(User $user)
    {
        $user->password = Hash::make('password123');
        $user->save();

        return back()->with('success', 'Password pengguna berhasil direset menjadi "password123".');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
