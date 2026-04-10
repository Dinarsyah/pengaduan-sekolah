<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Dashboard Siswa
     */
    public function dashboard()
    {
        $aspirasis = Aspirasi::where('user_id', Auth::id())
            ->with(['kategori', 'umpanBalik'])
            ->latest()
            ->get();

        $kategoris = Kategori::all();

        return view('siswa.dashboard', compact('aspirasis', 'kategoris'));
    }

    /**
     * Store Aspirasi Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'isi' => 'required|min:10'
        ]);

        Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim');
    }
}
