<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FasilitasKesehatanExport;

class FasilitasKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua fasilitas kesehatan (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = FasilitasKesehatan::orderBy('nama_faskes');

        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            // Mencari berdasarkan nama fasilitas, jenis, atau alamat
            $query->where('nama_faskes', 'LIKE', '%' . $search . '%')
                  ->orWhere('jenis_faskes', 'LIKE', '%' . $search . '%')
                  ->orWhere('alamat', 'LIKE', '%' . $search . '%');
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $fasilitas = $query->paginate(10)->withQueryString();
        return view('fasilitas_kesehatan.index', compact('fasilitas'));
    }

    /**
     * Menampilkan detail satu fasilitas kesehatan (READ - Show).
     */
    public function show(FasilitasKesehatan $fasilitasKesehatan)
    {
        return view('fasilitas_kesehatan.show', compact('fasilitasKesehatan'));
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
            // Validasi sinkron dengan nama kolom migrasi: nama_faskes, jenis_faskes, kontak
            'nama_faskes' => 'required|string|max:150|unique:fasilitas_kesehatan,nama_faskes',
            'jenis_faskes' => 'required|string|max:50', 
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20', 
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
            // Validasi sinkron dengan nama kolom migrasi: nama_faskes, jenis_faskes, kontak
            'nama_faskes' => 'required|string|max:150|unique:fasilitas_kesehatan,nama_faskes,' . $fasilitasKesehatan->id,
            'jenis_faskes' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20', 
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
        // Pengecekan relasi (asumsi Model FasilitasKesehatan memiliki relasi laporan())
        if ($fasilitasKesehatan->laporan()->exists()) {
             return redirect()->route('fasilitas-kesehatan.index')
                             ->with('error', 'Tidak dapat menghapus fasilitas ini karena sudah terkait dengan Laporan Kesehatan.');
        }

        $fasilitasKesehatan->delete();

        return redirect()->route('fasilitas-kesehatan.index')
                         ->with('success', 'Fasilitas Kesehatan berhasil dihapus.');
    }

    /**
     * Export data fasilitas kesehatan ke Excel
     */
    public function export()
    {
        $filename = 'Data_Fasilitas_Kesehatan_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new FasilitasKesehatanExport(), $filename);
    }
}