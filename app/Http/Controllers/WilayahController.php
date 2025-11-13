<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Menampilkan daftar semua data wilayah (READ)
     */
    public function index()
    {
        $wilayahs = Wilayah::orderBy('nama_wilayah')->paginate(10);
        return view('wilayah.index', compact('wilayahs'));
    }

    /**
     * Menampilkan form untuk menambah wilayah baru (CREATE form)
     */
    public function create()
    {
        return view('wilayah.create');
    }

    /**
     * Menyimpan data wilayah baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required|string|max:100|unique:wilayah,nama_wilayah',
            'kode_wilayah' => 'nullable|string|max:10|unique:wilayah,kode_wilayah',
            // Tambahkan validasi lain sesuai kolom di migrasi Anda
        ]);

        Wilayah::create($request->all());

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit wilayah (EDIT form)
     */
    public function edit(Wilayah $wilayah)
    {
        return view('wilayah.edit', compact('wilayah'));
    }

    /**
     * Memperbarui data wilayah (UPDATE logic)
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            // Pengecekan unique, kecuali ID wilayah saat ini
            'nama_wilayah' => 'required|string|max:100|unique:wilayah,nama_wilayah,'.$wilayah->id,
            'kode_wilayah' => 'nullable|string|max:10|unique:wilayah,kode_wilayah,'.$wilayah->id,
        ]);

        $wilayah->update($request->all());

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil diperbarui.');
    }

    /**
     * Menghapus data wilayah (DELETE)
     */
    public function destroy(Wilayah $wilayah)
    {
        // Pengecekan profesional: Jangan hapus wilayah jika masih ada penduduk di dalamnya
        if ($wilayah->penduduks()->exists()) {
             return redirect()->route('wilayah.index')
                             ->with('error', 'Tidak dapat menghapus wilayah karena masih terdapat Penduduk yang terdaftar di wilayah ini.');
        }

        $wilayah->delete();

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil dihapus.');
    }
}