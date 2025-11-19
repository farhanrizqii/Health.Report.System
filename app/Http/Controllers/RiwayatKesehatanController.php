<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKesehatan;
use App\Models\Penduduk;
use App\Models\KategoriPenyakit; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RiwayatKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua riwayat kesehatan (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = RiwayatKesehatan::with(['penduduk', 'kategoriPenyakit'])->orderBy('tanggal_pemeriksaan', 'desc');
        
        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            // Cari berdasarkan Nama Penduduk atau Nama Penyakit
            $query->whereHas('penduduk', function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                  ->orWhere('nik', 'LIKE', '%' . $search . '%');
            })->orWhereHas('kategoriPenyakit', function ($q) use ($search) {
                $q->where('nama_penyakit', 'LIKE', '%' . $search . '%');
            });
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $riwayats = $query->paginate(10)->withQueryString();
        return view('riwayat_kesehatan.index', compact('riwayats'));
    }

    /**
     * Menampilkan detail satu riwayat kesehatan (READ - Show).
     */
    public function show(RiwayatKesehatan $riwayatKesehatan)
    {
        // Load semua relasi yang diperlukan
        $riwayatKesehatan->load(['penduduk', 'kategoriPenyakit']); 
        return view('riwayat_kesehatan.show', compact('riwayatKesehatan'));
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
        // 1. Validasi Semua Input (termasuk yang akan di-mapping)
        $request->validate([
            'penduduk_id'            => 'required|exists:penduduk,id',
            'penyakit_id'            => 'required|exists:kategori_penyakit,id', // Foreign Key
            'tanggal_pemeriksaan'    => 'required|date',
            'jenis_pemeriksaan'      => 'required|string|max:100', // Sesuai kolom di migrasi
            'status_penyakit'        => 'required|in:Sembuh,Dirawat,Meninggal,Kronis', // Input dari form
            'keterangan_diagnosa'    => 'nullable|string|max:500', // Input dari form
        ]);

        // 2. Mapping Data ke Kolom Database yang Benar (hasil & tindakan)
        $data = [
            'penduduk_id' => $request->penduduk_id,
            'penyakit_id' => $request->penyakit_id,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            
            // MAPPING KRITIS: Memetakan input status_penyakit ke kolom 'hasil'
            'hasil' => $request->status_penyakit,      
            'tindakan' => $request->keterangan_diagnosa, // Memetakan keterangan ke kolom 'tindakan'
        ];

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
        // 1. Validasi Semua Input
        $request->validate([
            'penduduk_id'            => 'required|exists:penduduk,id',
            'penyakit_id'            => 'required|exists:kategori_penyakit,id',
            'tanggal_pemeriksaan'    => 'required|date',
            'jenis_pemeriksaan'      => 'required|string|max:100',
            'status_penyakit'        => 'required|in:Sembuh,Dirawat,Meninggal,Kronis',
            'keterangan_diagnosa'    => 'nullable|string|max:500',
        ]);
        
        // 2. Mapping Data ke Kolom Database yang Benar
        $data = [
            'penduduk_id' => $request->penduduk_id,
            'penyakit_id' => $request->penyakit_id,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            'hasil' => $request->status_penyakit, 
            'tindakan' => $request->keterangan_diagnosa,
        ];

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