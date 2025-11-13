<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    /**
     * Menampilkan daftar semua data imunisasi (READ)
     */
    public function index()
    {
        // Ambil data dengan eager loading Penduduk, diurutkan berdasarkan tanggal terbaru
        $imunisasis = Imunisasi::with('penduduk')->orderBy('tanggal_imunisasi', 'desc')->paginate(10);
        return view('imunisasi.index', compact('imunisasis'));
    }

    /**
     * Menampilkan form untuk menambah data imunisasi baru (CREATE form)
     */
    public function create()
    {
        // Ambil data penduduk yang akan diimunisasi (Hanya ID, NIK, dan Nama)
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        
        // Data master Jenis Imunisasi (Anda bisa ganti ini dengan data dari tabel master KategoriPenyakit jika lebih cocok)
        $jenisImunisasi = ['BCG', 'Polio', 'DPT', 'Campak', 'Hepatitis B', 'Lainnya'];

        return view('imunisasi.create', compact('penduduks', 'jenisImunisasi'));
    }

    /**
     * Menyimpan data imunisasi baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'jenis_imunisasi'   => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'keterangan'        => 'nullable|string|max:500',
            // 'petugas_id'       => 'nullable|exists:users,id', // Jika Anda mencatat petugas
        ]);

        Imunisasi::create($request->all());

        return redirect()->route('imunisasi.index')
                         ->with('success', 'Data Imunisasi berhasil dicatat.');
    }

    /**
     * Menampilkan form untuk mengedit data imunisasi (EDIT form)
     */
    public function edit(Imunisasi $imunisasi)
    {
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        $jenisImunisasi = ['BCG', 'Polio', 'DPT', 'Campak', 'Hepatitis B', 'Lainnya'];
        
        return view('imunisasi.edit', compact('imunisasi', 'penduduks', 'jenisImunisasi'));
    }

    /**
     * Memperbarui data imunisasi (UPDATE logic)
     */
    public function update(Request $request, Imunisasi $imunisasi)
    {
        $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'jenis_imunisasi'   => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'keterangan'        => 'nullable|string|max:500',
        ]);

        $imunisasi->update($request->all());

        return redirect()->route('imunisasi.index')
                         ->with('success', 'Data Imunisasi berhasil diperbarui.');
    }

    /**
     * Menghapus data imunisasi (DELETE)
     */
    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();

        return redirect()->route('imunisasi.index')
                         ->with('success', 'Data Imunisasi berhasil dihapus.');
    }
}