<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKesehatan;
use App\Models\Penduduk;
use App\Models\KategoriPenyakit;
use Illuminate\Http\Request;

class RiwayatKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua riwayat kesehatan (READ)
     */
    public function index()
    {
        $riwayats = RiwayatKesehatan::with(['penduduk', 'kategoriPenyakit'])
                                     ->orderBy('tanggal_tercatat', 'desc')
                                     ->paginate(10);
        return view('riwayat_kesehatan.index', compact('riwayats'));
    }

    /**
     * Menampilkan form untuk menambah riwayat kesehatan baru (CREATE form)
     */
    public function create()
    {
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->get();
        
        return view('riwayat_kesehatan.create', compact('penduduks', 'penyakits'));
    }

    /**
     * Menyimpan data riwayat kesehatan baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id'            => 'required|exists:penduduk,id',
            'penyakit_id'            => 'required|exists:kategori_penyakit,id', // PERBAIKAN
            'tanggal_tercatat'       => 'required|date',
            'status_penyakit'        => 'required|in:Sembuh,Dirawat,Meninggal,Kronis', 
            'keterangan_diagnosa'    => 'nullable|string|max:500',
        ]);
        
        // PENTING: Map input kategori_penyakit_id dari form ke kolom penyakit_id di DB
        $data = $request->except('kategori_penyakit_id');
        $data['penyakit_id'] = $request->kategori_penyakit_id;

        RiwayatKesehatan::create($data);

        return redirect()->route('riwayat-kesehatan.index')
                         ->with('success', 'Riwayat Kesehatan berhasil dicatat.');
    }

    /**
     * Menampilkan form untuk mengedit riwayat kesehatan (EDIT form)
     */
    public function edit(RiwayatKesehatan $riwayatKesehatan)
    {
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->get();
        
        return view('riwayat_kesehatan.edit', compact('riwayatKesehatan', 'penduduks', 'penyakits'));
    }

    /**
     * Memperbarui data riwayat kesehatan (UPDATE logic)
     */
    public function update(Request $request, RiwayatKesehatan $riwayatKesehatan)
    {
        $request->validate([
            'penduduk_id'            => 'required|exists:penduduk,id',
            'penyakit_id'            => 'required|exists:kategori_penyakit,id', // PERBAIKAN
            'tanggal_tercatat'       => 'required|date',
            'status_penyakit'        => 'required|in:Sembuh,Dirawat,Meninggal,Kronis',
            'keterangan_diagnosa'    => 'nullable|string|max:500',
        ]);
        
        // Map input kategori_penyakit_id dari form ke kolom penyakit_id di DB
        $data = $request->except('kategori_penyakit_id');
        $data['penyakit_id'] = $request->kategori_penyakit_id;

        $riwayatKesehatan->update($data);

        return redirect()->route('riwayat-kesehatan.index')
                         ->with('success', 'Riwayat Kesehatan berhasil diperbarui.');
    }

    /**
     * Menghapus riwayat kesehatan (DELETE)
     */
    public function destroy(RiwayatKesehatan $riwayatKesehatan)
    {
        $riwayatKesehatan->delete();

        return redirect()->route('riwayat-kesehatan.index')
                         ->with('success', 'Riwayat Kesehatan berhasil dihapus.');
    }
}