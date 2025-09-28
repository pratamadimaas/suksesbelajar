<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paket; // Import model Paket diperlukan untuk fitur assignPaket
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

        // Pastikan Anda memuat relasi 'role' jika ada
        $users = User::query()
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('name', 'asc')
                ->paginate(10); 

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
     * Simpan pengguna baru ke database dengan password otomatis (ADMIN FLOW)
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
        'role_id' => 1, // Menetapkan role 'siswa' dengan ID 1
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
    
    /**
     * Tampilkan form untuk menugaskan paket ke pengguna
     */
    public function assignPaketForm(User $user)
    {
        // Ambil semua paket yang tersedia
        $pakets = Paket::orderBy('nama_paket', 'asc')->get();

        // Ambil ID paket yang sudah ditugaskan ke pengguna ini menggunakan relasi database
        // **WORKAROUND DIHAPUS, MENGGUNAKAN RELASI PAKETS()**
        $assignedPaketIds = $user->pakets()->pluck('pakets.id')->toArray(); 

        return view('admin.users.assign-paket', compact('user', 'pakets', 'assignedPaketIds'));
    }

    /**
     * Simpan penugasan paket ke pengguna
     */
    public function saveAssignPaket(Request $request, User $user)
    {
        $request->validate([
            'paket_ids' => 'nullable|array',
            'paket_ids.*' => 'exists:pakets,id',
        ]);

        $paketIds = $request->input('paket_ids') ?? [];

        // **WORKAROUND DIHAPUS, MENGGUNAKAN FUNGSI SYNC() UNTUK MENYIMPAN KE TABEL PIVOT**
        // Sync akan menghapus relasi yang tidak dipilih dan menambahkan relasi yang dipilih.
        $user->pakets()->sync($paketIds);

        return redirect()->route('admin.users.index')
             ->with('success', 'Penugasan paket untuk ' . $user->name . ' berhasil diperbarui.');
    }
}
