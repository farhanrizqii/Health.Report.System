<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\ImunisasiExport; // Import class Export
use Maatwebsite\Excel\Facades\Excel; // Import facade Excel

class ImunisasiController extends Controller
{
    /**
     * Menampilkan daftar semua data imunisasi (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = Imunisasi::with('penduduk')->orderBy('tanggal_imunisasi', 'desc');

        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            // Mencari berdasarkan Nama Penduduk atau Jenis Imunisasi
            $query->where('jenis_imunisasi', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('penduduk', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'LIKE', '%' . $search . '%');
                  });
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $imunisasis = $query->paginate(10)->withQueryString();
        return view('imunisasi.index', compact('imunisasis'));
    }

    /**
     * Menampilkan detail satu catatan imunisasi (READ - Show).
     */
    public function show(Imunisasi $imunisasi)
    {
        // Load relasi Penduduk untuk detail
        $imunisasi->load('penduduk'); 
        return view('imunisasi.show', compact('imunisasi'));
    }

    /**
     * Menampilkan form untuk menambah data imunisasi baru (CREATE form)
     */
    public function create()
    {
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        
        $jenisImunisasi = ['BCG', 'Polio', 'DPT', 'Campak', 'Hepatitis B', 'Lainnya'];

        return view('imunisasi.create', compact('penduduks', 'jenisImunisasi'));
    }

    /**
     * Menyimpan data imunisasi baru (CREATE logic)
     */
    public function store(Request $request)
    {
        // PERBAIKAN KRITIS: Mengganti validasi 'keterangan' menjadi 'faskes'
        $validated = $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'jenis_imunisasi'   => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'faskes'            => 'nullable|string|max:500', // <-- NAMA KOLOM YANG BENAR
        ]);

        Imunisasi::create($validated); 

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
        // PERBAIKAN KRITIS: Mengganti validasi 'keterangan' menjadi 'faskes'
        $validated = $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'jenis_imunisasi'   => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'faskes'            => 'nullable|string|max:500', // <-- NAMA KOLOM YANG BENAR
        ]);

        $imunisasi->update($validated);

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

    /**
     * Export data imunisasi ke Excel
     */
    public function export()
    {
        return Excel::download(
            new ImunisasiExport, 
            'data_imunisasi_' . date('Y-m-d_His') . '.xlsx'
        );
    }
}