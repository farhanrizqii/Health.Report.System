<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Wilayah;
use App\Models\Role; // Diperlukan untuk RoleMiddleware (walaupun tidak digunakan di Controller ini)
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\PendudukExport; // Import class Export
use Maatwebsite\Excel\Facades\Excel; // Import facade Excel

class PendudukController extends Controller
{
    /**
     * Menampilkan daftar semua data penduduk (READ) dengan fitur Search
     */
    public function index(Request $request)
    {
        $query = Penduduk::with('wilayah')->orderBy('nama_lengkap');

        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            // Mencari berdasarkan nama lengkap atau NIK
            $query->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                  ->orWhere('nik', 'LIKE', '%' . $search . '%');
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $penduduks = $query->paginate(10)->withQueryString();
        return view('penduduk.index', compact('penduduks'));
    }

    /**
     * Menampilkan form untuk menambah penduduk baru (CREATE form)
     */
    public function create()
    {
        // Menggunakan 'kelurahan' sebagai kolom utama untuk display
        $wilayahs = Wilayah::orderBy('kelurahan')->get(); 
        return view('penduduk.create', compact('wilayahs'));
    }

    /**
     * Menyimpan data penduduk baru ke database (CREATE logic)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wilayah_id'    => 'required|exists:wilayah,id',
            'nik'           => 'required|string|size:16|unique:penduduk,nik',
            'nama_lengkap'  => 'required|string|max:150',
            'tanggal_lahir' => 'required|date|before_or_equal:today', // Tambah validasi tanggal
            // VALIDASI FINAL: Hanya menerima 'L' atau 'P'
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])], 
            'alamat'        => 'required|string',
            // Kolom baru/diperbaiki
            'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])], 
            'no_hp'         => 'nullable|string|max:15', 
            'no_kk'         => 'nullable|string|max:20', 
        ]);

        Penduduk::create($validated);

        return redirect()->route('penduduk.index')
                         ->with('success', 'Data Penduduk baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data penduduk tertentu (READ detail)
     */
    public function show(Penduduk $penduduk)
    {
        // Eager load relasi 'wilayah' untuk ditampilkan di view
        $penduduk->load('wilayah'); 
        
        return view('penduduk.show', compact('penduduk'));
    }
    
    /**
     * Menampilkan form untuk mengedit data penduduk (EDIT form)
     */
    public function edit(Penduduk $penduduk)
    {
        $wilayahs = Wilayah::orderBy('kelurahan')->get(); 
        return view('penduduk.edit', compact('penduduk', 'wilayahs'));
    }

    /**
     * Memperbarui data penduduk di database (UPDATE logic)
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'wilayah_id'    => 'required|exists:wilayah,id',
            // Pastikan NIK unik, kecuali untuk penduduk yang sedang diupdate
            'nik'           => 'required|string|size:16|unique:penduduk,nik,'.$penduduk->id, 
            'nama_lengkap'  => 'required|string|max:150',
            'tanggal_lahir' => 'required|date|before_or_equal:today', // Tambah validasi tanggal
            // VALIDASI FINAL: Hanya menerima 'L' atau 'P'
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])], 
            'alamat'        => 'required|string',
            // Kolom baru/diperbaiki
            'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])], 
            'no_hp'         => 'nullable|string|max:15', 
            'no_kk'         => 'nullable|string|max:20', 
        ]);

        $penduduk->update($validated);

        return redirect()->route('penduduk.index')
                         ->with('success', 'Data Penduduk berhasil diperbarui.');
    }

    /**
     * Menghapus data penduduk (DELETE)
     */
    public function destroy(Penduduk $penduduk)
    {
        try {
            $penduduk->delete();
            return redirect()->route('penduduk.index')
                             ->with('success', 'Data Penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika ada data terkait di tabel lain (Foreign Key Constraint)
            return redirect()->route('penduduk.index')
                             ->with('error', 'Gagal menghapus data. Data Penduduk ini mungkin memiliki riwayat terkait (misal: imunisasi, riwayat kesehatan).');
        }
    }

    /**
     * Export data penduduk ke Excel
     */
    public function export()
    {
        return Excel::download(
            new PendudukExport, 
            'data_penduduk_' . date('Y-m-d_His') . '.xlsx'
        );
    }
}