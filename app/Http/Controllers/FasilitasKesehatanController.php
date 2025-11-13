<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatan;
use Illuminate\Http\Request;

class FasilitasKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua fasilitas kesehatan (READ)
     */
    public function index()
    {
        // Mengubah orderBy dari 'nama_fasilitas' menjadi 'nama_faskes'
        $fasilitas = FasilitasKesehatan::orderBy('nama_faskes')->paginate(10);
        return view('fasilitas_kesehatan.index', compact('fasilitas'));
    }

    /**
     * Menampilkan form untuk menambah fasilitas baru (CREATE form)
     */
    public function create()
    {
        return view('fasilitas_kesehatan.create');
    }

    /**
     * Menyimpan data fasilitas baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Mengubah validasi untuk mencocokkan kolom migrasi
            'nama_faskes' => 'required|string|max:150|unique:fasilitas_kesehatan,nama_faskes',
            'jenis_faskes' => 'required|string|max:50', 
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20', // Menggunakan 'kontak'
        ]);

        FasilitasKesehatan::create($validated);

        return redirect()->route('fasilitas-kesehatan.index')
                         ->with('success', 'Fasilitas Kesehatan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit fasilitas (EDIT form)
     */
    public function edit(FasilitasKesehatan $fasilitasKesehatan)
    {
        return view('fasilitas_kesehatan.edit', compact('fasilitasKesehatan'));
    }

    /**
     * Memperbarui data fasilitas (UPDATE logic)
     */
    public function update(Request $request, FasilitasKesehatan $fasilitasKesehatan)
    {
        $validated = $request->validate([
            // Mengubah validasi untuk mencocokkan kolom migrasi dan pengecekan unik
            'nama_faskes' => 'required|string|max:150|unique:fasilitas_kesehatan,nama_faskes,' . $fasilitasKesehatan->id,
            'jenis_faskes' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20', // Menggunakan 'kontak'
        ]);

        $fasilitasKesehatan->update($validated);

        return redirect()->route('fasilitas-kesehatan.index')
                         ->with('success', 'Fasilitas Kesehatan berhasil diperbarui.');
    }

    /**
     * Menghapus fasilitas (DELETE)
     */
    public function destroy(FasilitasKesehatan $fasilitasKesehatan)
    {
        // Pengecekan relasi tetap sama
        if ($fasilitasKesehatan->laporan()->exists()) {
             return redirect()->route('fasilitas-kesehatan.index')
                             ->with('error', 'Tidak dapat menghapus fasilitas ini karena sudah terkait dengan Laporan Kesehatan.');
        }

        $fasilitasKesehatan->delete();

        return redirect()->route('fasilitas-kesehatan.index')
                         ->with('success', 'Fasilitas Kesehatan berhasil dihapus.');
    }
}