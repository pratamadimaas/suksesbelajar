<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soal::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.soal.index', compact('soals'));
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|in:TWK,TIU,TKP',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D,E',
            'skor_a' => 'nullable|integer|min:0|max:5',
            'skor_b' => 'nullable|integer|min:0|max:5',
            'skor_c' => 'nullable|integer|min:0|max:5',
            'skor_d' => 'nullable|integer|min:0|max:5',
            'skor_e' => 'nullable|integer|min:0|max:5',
            'pembahasan' => 'nullable|string',
        ]);

        // Atur nilai default 0 untuk semua skor
        $skorData = [
            'skor_a' => 0,
            'skor_b' => 0,
            'skor_c' => 0,
            'skor_d' => 0,
            'skor_e' => 0,
        ];

        // Logika skor berdasarkan kategori
        if ($validated['kategori'] === 'TKP') {
            $skorData = [
                'skor_a' => $validated['skor_a'] ?? 0,
                'skor_b' => $validated['skor_b'] ?? 0,
                'skor_c' => $validated['skor_c'] ?? 0,
                'skor_d' => $validated['skor_d'] ?? 0,
                'skor_e' => $validated['skor_e'] ?? 0,
            ];
        } else {
            // Untuk TWK dan TIU, berikan skor 5 pada kunci jawaban
            $correctOption = strtolower($validated['kunci_jawaban']);
            $skorData['skor_' . $correctOption] = 5;
        }

        // Gabungkan data yang sudah divalidasi dengan data skor
        $mergedData = array_merge($validated, $skorData);

        Soal::create($mergedData);

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil ditambahkan');
    }

    public function show(Soal $soal)
    {
        return view('admin.soal.show', compact('soal'));
    }

    public function edit(Soal $soal)
    {
        return view('admin.soal.edit', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        $validated = $request->validate([
            'kategori' => 'required|in:TWK,TIU,TKP',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D,E',
            'skor_a' => 'nullable|integer|min:0|max:5',
            'skor_b' => 'nullable|integer|min:0|max:5',
            'skor_c' => 'nullable|integer|min:0|max:5',
            'skor_d' => 'nullable|integer|min:0|max:5',
            'skor_e' => 'nullable|integer|min:0|max:5',
            'pembahasan' => 'nullable|string',
        ]);
        
        // Atur nilai default 0 untuk semua skor
        $skorData = [
            'skor_a' => 0,
            'skor_b' => 0,
            'skor_c' => 0,
            'skor_d' => 0,
            'skor_e' => 0,
        ];

        // Logika skor berdasarkan kategori
        if ($validated['kategori'] === 'TKP') {
            $skorData = [
                'skor_a' => $validated['skor_a'] ?? 0,
                'skor_b' => $validated['skor_b'] ?? 0,
                'skor_c' => $validated['skor_c'] ?? 0,
                'skor_d' => $validated['skor_d'] ?? 0,
                'skor_e' => $validated['skor_e'] ?? 0,
            ];
        } else {
            // Untuk TWK dan TIU, berikan skor 5 pada kunci jawaban
            $correctOption = strtolower($validated['kunci_jawaban']);
            $skorData['skor_' . $correctOption] = 5;
        }

        // Gabungkan data yang sudah divalidasi dengan data skor
        $mergedData = array_merge($validated, $skorData);

        $soal->update($mergedData);

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil diupdate');
    }

    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil dihapus');
    }

    public function toggle(Soal $soal)
    {
        $soal->update(['is_active' => !$soal->is_active]);
        return response()->json(['success' => true]);
    }
}
