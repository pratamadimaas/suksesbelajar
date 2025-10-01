<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MateriAjar; 
use Illuminate\Http\Request;

class SiswaMateriController extends Controller
{
    /**
     * Menampilkan daftar semua materi ajar yang sudah dipublikasikan.
     */
    public function index()
    {
        // Hanya ambil materi yang sudah dipublikasikan
        $materis = MateriAjar::where('is_published', true)
                            ->latest()
                            ->paginate(12);

        return view('siswa.materi.index', compact('materis'));
    }

    /**
     * Menampilkan detail dari satu materi ajar.
     */
    public function show(MateriAjar $materi)
    {
        // Pastikan materi yang diakses sudah dipublikasikan
        if (!$materi->is_published) {
            return redirect()->route('siswa.materi.index')->with('error', 'Materi tidak ditemukan atau belum dipublikasikan.');
        }

        return view('siswa.materi.show', compact('materi'));
    }
}
