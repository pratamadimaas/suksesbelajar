<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Paket;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UjianExport;
use PDF;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan detail dan leaderboard.
     * Menggunakan dua query terpisah untuk masing-masing tab.
     */
    public function index(Request $request)
    {
        // 1. Logika untuk Laporan Detail
        $queryLaporan = Ujian::with(['user', 'paket'])
            ->where('status', 'finished')
            ->orderBy('created_at', 'desc');

        if ($request->filled('paket_id_laporan')) {
            $queryLaporan->where('paket_id', $request->paket_id_laporan);
        }

        if ($request->filled('tanggal_mulai')) {
            $queryLaporan->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $queryLaporan->whereDate('created_at', '<=', $request->tanggal_selesai);
        }
        
        $laporan_ujians = $queryLaporan->paginate(20, ['*'], 'laporan_page')->appends($request->query());

        // 2. Logika untuk Leaderboard
        $queryLeaderboard = Ujian::with('user')
            ->where('status', 'finished');

        // Filter leaderboard berdasarkan paket yang dipilih
        if ($request->filled('paket_id_leaderboard')) {
            $queryLeaderboard->where('paket_id', $request->paket_id_leaderboard);
        }
        
        // Mengurutkan leaderboard berdasarkan skor tertinggi
        $queryLeaderboard->orderBy('total_skor', 'desc');

        $leaderboard_ujians = $queryLeaderboard->paginate(20, ['*'], 'leaderboard_page')->appends($request->query());

        // Ambil semua paket yang aktif untuk dropdown filter
        $pakets = Paket::where('is_active', true)->get();

        return view('admin.laporan.index', compact('laporan_ujians', 'leaderboard_ujians', 'pakets'));
    }

    /**
     * Menghapus semua data ujian untuk paket tertentu, mereset leaderboard.
     */
    public function resetLeaderboard(Request $request, $paketId)
    {
        // Pastikan hanya admin yang bisa melakukan aksi ini
        if (auth()->user()->role->name !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        
        // Menghapus semua ujian yang berelasi dengan paket tersebut
        Ujian::where('paket_id', $paketId)->delete();
        
        return back()->with('success', 'Leaderboard berhasil direset.');
    }

    /**
     * Mengekspor data laporan ke format Excel atau PDF.
     */
    public function export(Request $request, $type)
    {
        $query = Ujian::with(['user', 'paket'])
            ->where('status', 'finished');

        // Terapkan filter yang sama seperti halaman index
        if ($request->paket_id) {
            $query->where('paket_id', $request->paket_id);
        }

        if ($request->tanggal_mulai) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->tanggal_selesai) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        $ujians = $query->get();

        if ($type === 'excel') {
            return Excel::download(new UjianExport($ujians), 'laporan-ujian.xlsx');
        }

        if ($type === 'pdf') {
            $pdf = PDF::loadView('admin.laporan.pdf', compact('ujians'));
            return $pdf->download('laporan-ujian.pdf');
        }

        return redirect()->back()->with('error', 'Format tidak valid');
    }

    /**
     * Menghapus satu data ujian.
     */
    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();
        
        return back()->with('success', 'Data ujian berhasil dihapus.');
    }
}
