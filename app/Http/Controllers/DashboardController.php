<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Paket;

class DashboardController extends Controller
{
    public function siswa()
    {
        $user = auth()->user();
        $riwayatUjian = Ujian::where('user_id', $user->id)
            ->with('paket')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pakets = Paket::where('is_active', true)->get();
        
        return view('siswa.dashboard', compact('riwayatUjian', 'pakets'));
    }

    public function admin()
    {
        $totalSiswa = \App\Models\User::where('role_id', 1)->count();
        $totalSoal = \App\Models\Soal::count();
        $totalUjian = Ujian::count();
        $totalPaket = Paket::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalSoal', 'totalUjian', 'totalPaket'));
    }
}
