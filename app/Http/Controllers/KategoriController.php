<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index()
    {
        $kategoris = Kategori::withCount('aspirasis')->latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Tambah kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Cek apakah kategori masih digunakan
        if ($kategori->aspirasis()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam aspirasi');
        }
        
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
