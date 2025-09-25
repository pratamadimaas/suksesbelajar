<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\UjianJawaban;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Tampilkan halaman instruksi ujian
     */
    public function show(Paket $paket)
    {
        return view('siswa.ujian.halamanujian', compact('paket'));
    }

    /**
     * Mulai ujian baru atau lanjutkan jika sudah ada yang ongoing
     */
    public function start(Request $request, Paket $paket)
    {
        $user = auth()->user();
        
        // Cek apakah user sudah menyelesaikan ujian untuk paket ini
        $finishedUjian = Ujian::where('user_id', $user->id)
            ->where('paket_id', $paket->id)
            ->where('status', 'finished')
            ->first();

        if ($finishedUjian) {
            return redirect()->back()->with('error', 'Anda hanya dapat mengambil ujian ini sekali.');
        }

        // Cek ujian ongoing
        $ongoingUjian = Ujian::where('user_id', $user->id)
            ->where('paket_id', $paket->id)
            ->where('status', 'ongoing')
            ->first();

        if ($ongoingUjian) {
            return redirect()->route('ujian.soal', [
                'ujian' => $ongoingUjian->id, 
                'nomor' => 1
            ]);
        }

        // Buat ujian baru
        $ujian = Ujian::create([
            'user_id' => $user->id,
            'paket_id' => $paket->id,
            'mulai_ujian' => now(),
            'status' => 'ongoing'
        ]);

        // Generate soal random
        $this->generateSoalUjian($ujian, $paket);

        return redirect()->route('ujian.soal', [
            'ujian' => $ujian->id, 
            'nomor' => 1
        ]);
    }

    /**
     * Tampilkan soal berdasarkan nomor
     */
    public function soal(Ujian $ujian, $nomor)
    {
        if ($ujian->user_id !== auth()->id() || $ujian->status !== 'ongoing') {
            return redirect()->route('dashboard');
        }

        // Hitung waktu habis
        $waktuHabis = Carbon::parse($ujian->mulai_ujian)->addMinutes($ujian->paket->waktu_ujian);
        if (now() > $waktuHabis) {
            $this->submitUjian($ujian);
            return redirect()->route('ujian.hasil', $ujian);
        }

        $soals = $ujian->ujianJawabans()->with('soal')->orderBy('id')->get();
        $totalSoal = $soals->count();

        if ($nomor > $totalSoal || $nomor < 1) {
            return redirect()->route('ujian.soal', ['ujian' => $ujian->id, 'nomor' => 1]);
        }

        $currentSoal = $soals[$nomor - 1];
        $sisaWaktu = $waktuHabis->diffInSeconds(now());

        return view('siswa.halamansoal', compact(
            'ujian', 'currentSoal', 'nomor', 'totalSoal', 'sisaWaktu', 'soals'
        ));
    }

    /**
     * Simpan jawaban user
     */
    public function jawab(Request $request, Ujian $ujian)
    {
        $request->validate([
            'soal_id' => 'required|exists:soals,id',
            'jawaban' => 'required|in:A,B,C,D,E'
        ]);

        $ujianJawaban = UjianJawaban::where('ujian_id', $ujian->id)
            ->where('soal_id', $request->soal_id)
            ->first();

        if ($ujianJawaban) {
            $soal = $ujianJawaban->soal;
            
            if ($soal->kategori === 'TKP') {
                $skor = $this->getSkorTKP($soal, $request->jawaban);
                $isCorrect = false; // TKP tidak ada benar/salah
            } else {
                $isCorrect = $soal->kunci_jawaban === $request->jawaban;
                $skor = $isCorrect ? 5 : 0; 
            }

            $ujianJawaban->update([
                'jawaban' => $request->jawaban,
                'is_correct' => $isCorrect,
                'skor' => $skor
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Submit ujian
     */
    public function submit(Ujian $ujian)
    {
        $this->submitUjian($ujian);
        return redirect()->route('ujian.hasil', $ujian);
    }

    /**
     * Tampilkan hasil ujian user
     */
    public function hasil(Ujian $ujian)
    {
        if ($ujian->user_id !== auth()->id() || $ujian->status === 'ongoing') {
            return redirect()->route('dashboard');
        }

        $jawabans = $ujian->ujianJawabans()->with('soal')->get();
        $ranking = $this->getRanking($ujian);

        return view('siswa.halamanhasil', compact('ujian', 'jawabans', 'ranking'));
    }

    /**
     * Leaderboard berdasarkan paket
     */
    public function leaderboard(Request $request)
    {
        $pakets = Paket::all();
        $paketId = $request->paket_id;

        $ujians = Ujian::with('user')
            ->when($paketId, fn($q) => $q->where('paket_id', $paketId))
            ->where('status', 'finished')
            ->orderByDesc('total_skor')
            ->paginate(10);

        return view('siswa.leaderboard', compact('pakets', 'ujians'));
    }

    /**
     * Generate soal random untuk ujian
     */
    private function generateSoalUjian(Ujian $ujian, Paket $paket)
    {
        $soalTWK = Soal::where('kategori', 'TWK')->where('is_active', true)
            ->inRandomOrder()->limit($paket->jumlah_soal_twk)->get();

        $soalTIU = Soal::where('kategori', 'TIU')->where('is_active', true)
            ->inRandomOrder()->limit($paket->jumlah_soal_tiu)->get();

        $soalTKP = Soal::where('kategori', 'TKP')->where('is_active', true)
            ->inRandomOrder()->limit($paket->jumlah_soal_tkp)->get();

        $allSoals = collect()->merge($soalTWK)->merge($soalTIU)->merge($soalTKP)->shuffle();

        foreach ($allSoals as $soal) {
            UjianJawaban::create([
                'ujian_id' => $ujian->id,
                'soal_id' => $soal->id,
                'jawaban' => null,
                'is_correct' => false,
                'skor' => 0
            ]);
        }
    }

    /**
     * Hitung skor & update ujian
     */
    private function submitUjian(Ujian $ujian)
    {
        $jawabans = $ujian->ujianJawabans()->with('soal')->get();
        
        $skorTWK = $jawabans->where('soal.kategori', 'TWK')->sum('skor');
        $skorTIU = $jawabans->where('soal.kategori', 'TIU')->sum('skor');
        $skorTKP = $jawabans->where('soal.kategori', 'TKP')->sum('skor');
        $totalSkor = $skorTWK + $skorTIU + $skorTKP;

        $ujian->update([
            'selesai_ujian' => now(),
            'skor_twk' => $skorTWK,
            'skor_tiu' => $skorTIU,
            'skor_tkp' => $skorTKP,
            'total_skor' => $totalSkor,
            'status' => 'finished'
        ]);
    }

    /**
     * Hapus ujian
     *
     * @param Ujian $ujian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminDestroy(Ujian $ujian)
    {
        $ujian->delete();
        return back()->with('success', 'Data ujian berhasil dihapus.');
    }

    /**
     * Reset leaderboard untuk paket tertentu
     *
     * @param Paket $paket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetLeaderboard(Paket $paket)
    {
        Ujian::where('paket_id', $paket->id)->delete();
        return back()->with('success', 'Leaderboard berhasil direset untuk paket ini.');
    }

    /**
     * Hitung skor TKP
     */
    private function getSkorTKP(Soal $soal, $jawaban)
    {
        return match($jawaban) {
            'A' => $soal->skor_a,
            'B' => $soal->skor_b,
            'C' => $soal->skor_c,
            'D' => $soal->skor_d,
            'E' => $soal->skor_e,
            default => 0
        };
    }

    /**
     * Ranking user pada paket tertentu
     */
    private function getRanking(Ujian $ujian)
    {
        $betterScores = Ujian::where('paket_id', $ujian->paket_id)
            ->where('total_skor', '>', $ujian->total_skor)
            ->where('status', 'finished')
            ->count();
        
        return $betterScores + 1;
    }

    public function showResult($id)
{
    // Mengambil data ujian dan relasi yang diperlukan
    $ujian = Ujian::with(['paket', 'ujianJawabans.soal'])->findOrFail($id);
    
    // Logika untuk menghitung ranking
    $ranking = Ujian::where('total_skor', '>', $ujian->total_skor)->count() + 1;

    return view('ujian.hasil', compact('ujian', 'ranking'));
}
}
