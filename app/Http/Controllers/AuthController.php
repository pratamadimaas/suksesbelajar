<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCredentialsMail; // Menggunakan Mailable yang sama
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Tentukan rute pengalihan berdasarkan role pengguna
            $redirectPath = match (Auth::user()->role->name) {
                'admin' => route('admin.dashboard'),
                'siswa' => route('siswa.dashboard'),
                default => route('home'), // Fallback
            };

            return redirect()->intended($redirectPath);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Tampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    /**
     * Proses registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15|unique:users', // Validation for phone
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $password_plaintext = $request->password; // Simpan password sebelum di-hash

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone, // Save phone number
            'email' => $request->email,
            'password' => Hash::make($password_plaintext),
            'role_id' => 1, // Secara default, pengguna yang mendaftar adalah 'siswa'
        ]);

        // --- Logika Pengiriman Email ---
        try {
            // Kirim email ke pengguna, menggunakan password plaintext yang mereka masukkan
            Mail::to($user->email)->send(new UserCredentialsMail($user, $password_plaintext));
        } catch (\Exception $e) {
            // Catat error jika pengiriman email gagal
            Log::error('Gagal mengirim email kredensial saat registrasi mandiri: ' . $user->email . ' | Error: ' . $e->getMessage());
        }
        // ---------------------------------

        // Login pengguna setelah registrasi
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil didaftarkan. Detail login Anda telah dikirim ke email Anda.');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
