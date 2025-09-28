<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth manual
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (hanya bisa diakses kalau sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Redirect dashboard sesuai role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('siswa.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Siswa Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:siswa')->group(function () {
        Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
        
        // Profil dan Ganti Password Siswa
        Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
        Route::put('/siswa/profile/update-password', [SiswaController::class, 'updatePassword'])->name('siswa.updatePassword');

        // Ujian
        Route::prefix('ujian')->name('ujian.')->group(function () {
            Route::get('/', [UjianController::class, 'leaderboard'])->name('leaderboard');
            Route::get('/{paket}', [UjianController::class, 'show'])->name('show');
            Route::post('/{paket}/start', [UjianController::class, 'start'])->name('start');
            Route::get('/{ujian}/soal/{nomor}', [UjianController::class, 'soal'])
                ->name('soal')
                ->where('nomor', '[0-9]+');
            Route::post('/{ujian}/jawab', [UjianController::class, 'jawab'])->name('jawab');
            Route::post('/{ujian}/submit', [UjianController::class, 'submit'])->name('submit');
            Route::get('/{ujian}/hasil', [UjianController::class, 'hasil'])->name('hasil');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Soal Management
        Route::resource('soal', SoalController::class);
        Route::post('soal/{soal}/toggle', [SoalController::class, 'toggle'])->name('soal.toggle');

        // Paket Management
        Route::resource('paket', PaketController::class);
        Route::get('paket/{paket}/assign-soal', [PaketController::class, 'assignSoal'])->name('paket.assign');
        Route::post('paket/{paket}/save-soal', [PaketController::class, 'saveSoal'])->name('paket.save-soal');

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/export/{type}', [LaporanController::class, 'export'])->name('laporan.export');
        
        // Admin Ujian & Leaderboard Management
        Route::delete('ujian/destroy/{id}', [LaporanController::class, 'destroy'])->name('ujian.destroy');
        // Perbaikan di sini, mengarah ke LaporanController
        Route::delete('leaderboard/reset/{paketId}', [LaporanController::class, 'resetLeaderboard'])->name('leaderboard.reset');

        // User Management
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Fallback (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
