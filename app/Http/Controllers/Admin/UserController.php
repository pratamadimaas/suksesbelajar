<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\Log; // Tambahkan import Log

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = \App\Models\User::query()
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('name', 'asc')
                ->paginate(10); // 10 data per halaman

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Tampilkan form untuk menambah pengguna baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan pengguna baru ke database dengan password otomatis
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
    ]);

    // Hitung jumlah pengguna yang ada untuk membuat password unik
    $userCount = User::count() + 1;
    $generatedPassword = 'password' . $userCount;

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($generatedPassword),
        'role_id' => 2, // Menetapkan role 'siswa' dengan ID 2
    ]);

    // --- Logika Pengiriman Email ---
    try {
        // Kirim email ke pengguna dengan detail login
        Mail::to($user->email)->send(new UserCredentialsMail($user, $generatedPassword));
    } catch (\Exception $e) {
        // Catat error jika pengiriman email gagal
        Log::error('Gagal mengirim email kredensial untuk pengguna baru: ' . $user->email . ' | Error: ' . $e->getMessage());
    }
    // ---------------------------------

    // Arahkan kembali dengan pesan sukses yang menyertakan password
    return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan dan email kredensial telah dikirim. Password default: "' . $generatedPassword . '".');
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
