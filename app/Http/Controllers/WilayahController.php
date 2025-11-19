<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\Role;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WilayahExport;

class WilayahController extends Controller
{
    /**
     * Menampilkan daftar semua data wilayah (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = Wilayah::orderBy('kelurahan');
        
        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            $query->where('kelurahan', 'LIKE', '%' . $search . '%')
                  ->orWhere('rw', 'LIKE', '%' . $search . '%')
                  ->orWhere('rt', 'LIKE', '%' . $search . '%');
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $wilayahs = $query->paginate(10)->withQueryString();
        
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
            'kelurahan' => 'required|string|max:100|unique:wilayah,kelurahan',
            'rw' => 'nullable|string|max:10',
            'rt' => 'nullable|string|max:10',
            'parent_id' => 'nullable|exists:wilayah,id',
        ]);

        Wilayah::create($request->all());

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu wilayah (READ - Show)
     */
    public function show(Wilayah $wilayah)
    {
        return view('wilayah.show', compact('wilayah'));
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
            'kelurahan' => 'required|string|max:100|unique:wilayah,kelurahan,'.$wilayah->id,
            'rw' => 'nullable|string|max:10',
            'rt' => 'nullable|string|max:10',
            'parent_id' => 'nullable|exists:wilayah,id',
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
        if ($wilayah->penduduks()->exists()) {
             return redirect()->route('wilayah.index')
                             ->with('error', 'Tidak dapat menghapus wilayah karena masih terdapat Penduduk yang terdaftar di wilayah ini.');
        }

        $wilayah->delete();

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil dihapus.');
    }

    /**
     * Export data wilayah ke Excel
     */
    public function export()
    {
        $filename = 'Data_Wilayah_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new WilayahExport(), $filename);
    }
}