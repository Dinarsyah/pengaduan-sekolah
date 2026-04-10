<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\UmpanBalik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard Admin/Guru
     */
    public function dashboard(Request $request)
    {
        $query = Aspirasi::with(['user', 'kategori', 'umpanBalik']);
        
        // Filter berdasarkan request
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }
        
        if ($request->has('bulan') && $request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }
        
        if ($request->has('tahun') && $request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }
        
        if ($request->has('siswa_id') && $request->siswa_id) {
            $query->where('user_id', $request->siswa_id);
        }
        
        if ($request->has('kategori_id') && $request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $aspirasis = $query->latest()->paginate(10);
        $kategoris = Kategori::all();
        $siswas = User::where('role', 'siswa')->get();
        
        return view('admin.dashboard', compact('aspirasis', 'kategoris', 'siswas'));
    }

    /**
     * Filter Aspirasi (Alias untuk dashboard dengan filter)
     */
    public function filterAspirasi(Request $request)
    {
        return $this->dashboard($request);
    }

    /**
     * Update Status Aspirasi
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->status = $request->status;
        $aspirasi->save();

        return back()->with('success', 'Status aspirasi berhasil diubah');
    }

    /**
     * Berikan Umpan Balik
     */
    public function giveFeedback(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|min:5'
        ]);

        UmpanBalik::updateOrCreate(
            ['aspirasi_id' => $id],
            ['isi' => $request->isi]
        );

        return back()->with('success', 'Umpan balik berhasil dikirim');
    }

    /**
     * Hapus Aspirasi
     */
    public function deleteAspirasi($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();

        return back()->with('success', 'Aspirasi berhasil dihapus');
    }
}
