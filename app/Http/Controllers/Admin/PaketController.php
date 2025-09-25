<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Soal;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::withCount('soals')->orderBy('created_at', 'desc')->get();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_soal_twk' => 'required|integer|min:1',
            'jumlah_soal_tiu' => 'required|integer|min:1',
            'jumlah_soal_tkp' => 'required|integer|min:1',
            'waktu_ujian' => 'required|integer|min:30',
        ]);

        Paket::create($validated);

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil ditambahkan');
    }

    public function show(Paket $paket)
    {
        $paket->load(['soals', 'ujians.user']);
        return view('admin.paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_soal_twk' => 'required|integer|min:1',
            'jumlah_soal_tiu' => 'required|integer|min:1',
            'jumlah_soal_tkp' => 'required|integer|min:1',
            'waktu_ujian' => 'required|integer|min:30',
        ]);

        $paket->update($validated);

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil diupdate');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil dihapus');
    }

    // Menampilkan halaman untuk menetapkan soal ke paket
    public function assignSoal(Paket $paket)
    {
        $soals = Soal::orderBy('kategori')->get();
        $assignedSoalIds = $paket->soals()->pluck('soals.id')->toArray();

        return view('admin.paket.assign-soal', compact('paket', 'soals', 'assignedSoalIds'));
    }

    // Menyimpan soal yang dipilih ke paket
    public function saveSoal(Request $request, Paket $paket)
    {
        $validated = $request->validate([
            'soal_ids' => 'nullable|array',
            'soal_ids.*' => 'exists:soals,id'
        ]);

        $soalIds = $validated['soal_ids'] ?? [];

        // Sinkronkan soal dengan pivot table paket_soals
        $paket->soals()->sync($soalIds);

        return redirect()->route('admin.paket.index')
            ->with('success', 'Soal berhasil ditetapkan ke paket.');
    }
}
