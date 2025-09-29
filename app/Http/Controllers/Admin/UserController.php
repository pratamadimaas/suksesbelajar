<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('role_id', 1) // HANYA tampilkan siswa di sini (asumsi)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%"); // Tambahkan pencarian berdasarkan phone
            })
            ->orderBy('name', 'asc')
            ->paginate(10); 

        // Untuk mengisi dropdown aksi massal
        $pakets = Paket::orderBy('nama_paket')->get(['id', 'nama_paket']);

        // Mengirim data users dan pakets ke view
        return view('admin.users.index', compact('users', 'search', 'pakets'));
    }
    
    // --- FUNGSI BARU UNTUK AKSI MASSAL ---

    /**
     * Menugaskan paket yang dipilih ke daftar pengguna yang dicentang.
     */
    public function assignPaketSelected(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'paket_id' => 'required|exists:pakets,id'
        ], [
            'user_ids.required' => 'Minimal satu pengguna harus dipilih.',
            'paket_id.required' => 'Anda harus memilih paket untuk ditugaskan.'
        ]);

        $userIds = $validated['user_ids'];
        $paketId = $validated['paket_id'];

        $paket = Paket::findOrFail($paketId);
        $users = User::whereIn('id', $userIds)->get();

        $assignedCount = 0;

        foreach ($users as $user) {
            // Gunakan syncWithoutDetaching untuk MENAMBAH paket tanpa menghapus paket lama
            $user->pakets()->syncWithoutDetaching([$paketId]);
            $assignedCount++;
        }

        return redirect()->route('admin.users.index')
                         ->with('success', "Berhasil menugaskan paket '{$paket->nama_paket}' kepada {$assignedCount} pengguna yang dipilih.");
    }
    
    // --- END FUNGSI BARU ---


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
            'phone' => 'nullable|string|max:15|unique:users', // Pastikan validasi phone ada
        ]);

        $userCount = User::count() + 1;
        $generatedPassword = 'password' . $userCount;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Pastikan field phone disimpan
            'password' => Hash::make($generatedPassword),
            'role_id' => 1, // Menetapkan role 'siswa' dengan ID 1
        ]);

        // --- Logika Pengiriman Email ---
        try {
            Mail::to($user->email)->send(new UserCredentialsMail($user, $generatedPassword));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email kredensial untuk pengguna baru: ' . $user->email . ' | Error: ' . $e->getMessage());
        }
        // ---------------------------------

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
        $pakets = Paket::orderBy('nama_paket', 'asc')->get();
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

        $user->pakets()->sync($paketIds);

        return redirect()->route('admin.users.index')
             ->with('success', 'Penugasan paket untuk ' . $user->name . ' berhasil diperbarui.');
    }
}
