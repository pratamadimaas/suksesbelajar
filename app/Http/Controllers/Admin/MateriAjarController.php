<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MateriAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriAjarController extends Controller
{
    /**
     * Menampilkan daftar materi ajar.
     */
    public function index()
    {
        $materis = MateriAjar::latest()->paginate(10);
        return view('admin.materi.index', compact('materis'));
    }

    /**
     * Menampilkan form untuk membuat materi ajar baru.
     */
    public function create()
    {
        return view('admin.materi.create');
    }

    /**
     * Menyimpan materi ajar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'isi_materi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Maks 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi_files', 'public');
        }

        MateriAjar::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'isi_materi' => $request->isi_materi,
            'file_path' => $filePath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi ajar berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit materi ajar.
     */
    public function edit(MateriAjar $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    /**
     * Memperbarui materi ajar di database.
     */
    public function update(Request $request, MateriAjar $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'isi_materi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $materi->file_path;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('materi_files', 'public');
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'isi_materi' => $request->isi_materi,
            'file_path' => $filePath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi ajar berhasil diperbarui!');
    }

    /**
     * Menghapus materi ajar.
     */
    public function destroy(MateriAjar $materi)
    {
        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi ajar berhasil dihapus!');
    }
}