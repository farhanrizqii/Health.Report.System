<?php

namespace App\Http\Controllers;

use App\Models\KategoriPenyakit;
use Illuminate\Http\Request;

class KategoriPenyakitController extends Controller
{
    /**
     * Menampilkan daftar semua kategori penyakit (READ)
     */
    public function index()
    {
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->paginate(10);
        return view('kategori_penyakit.index', compact('penyakits'));
    }

    /**
     * Menampilkan form untuk menambah kategori baru (CREATE form)
     */
    public function create()
    {
        return view('kategori_penyakit.create');
    }

    /**
     * Menyimpan data kategori baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:150|unique:kategori_penyakit,nama_penyakit',
            'kode_icd'      => 'nullable|string|max:10|unique:kategori_penyakit,kode_icd',
        ]);

        KategoriPenyakit::create($request->all());

        return redirect()->route('kategori-penyakit.index')
                         ->with('success', 'Kategori Penyakit berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori (EDIT form)
     */
    public function edit(KategoriPenyakit $kategoriPenyakit)
    {
        return view('kategori_penyakit.edit', compact('kategoriPenyakit'));
    }

    /**
     * Memperbarui data kategori (UPDATE logic)
     */
    public function update(Request $request, KategoriPenyakit $kategoriPenyakit)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:150|unique:kategori_penyakit,nama_penyakit,'.$kategoriPenyakit->id,
            'kode_icd'      => 'nullable|string|max:10|unique:kategori_penyakit,kode_icd,'.$kategoriPenyakit->id,
        ]);

        $kategoriPenyakit->update($request->all());

        return redirect()->route('kategori-penyakit.index')
                         ->with('success', 'Kategori Penyakit berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (DELETE)
     */
    public function destroy(KategoriPenyakit $kategoriPenyakit)
    {
        // Pengecekan profesional: Jangan hapus jika sudah ada riwayat
        if ($kategoriPenyakit->riwayatKesehatan()->exists()) {
             return redirect()->route('kategori-penyakit.index')
                             ->with('error', 'Tidak dapat menghapus kategori ini karena sudah terkait dengan Riwayat Kesehatan.');
        }

        $kategoriPenyakit->delete();

        return redirect()->route('kategori-penyakit.index')
                         ->with('success', 'Kategori Penyakit berhasil dihapus.');
    }
}