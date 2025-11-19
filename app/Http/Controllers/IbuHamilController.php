<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\Penduduk;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\IbuHamilExport; // Import class Export
use Maatwebsite\Excel\Facades\Excel; // Import facade Excel

class IbuHamilController extends Controller
{
    /**
     * Menampilkan daftar semua data ibu hamil (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = IbuHamil::with('penduduk')->orderBy('id', 'desc');

        // --- LOGIKA PENCARIAN ---
        if ($request->search) {
            $search = $request->search;
            // Menggunakan whereHas untuk mencari di Model Penduduk (Nama atau NIK)
            $query->whereHas('penduduk', function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                  ->orWhere('nik', 'LIKE', '%' . $search . '%');
            });
        }
        // --- AKHIR LOGIKA PENCARIAN ---

        $ibuHamils = $query->paginate(10)->withQueryString();
        return view('ibuhamil.index', compact('ibuHamils'));
    }
    
    /**
     * Menampilkan detail satu catatan ibu hamil (READ - Show).
     */
    public function show(IbuHamil $ibuHamil)
    {
        // Load relasi Penduduk untuk detail
        $ibuHamil->load('penduduk'); 
        return view('ibuhamil.show', compact('ibuHamil'));
    }

    /**
     * Menampilkan form untuk menambah catatan baru (CREATE form)
     */
    public function create()
    {
        // Ambil hanya penduduk perempuan ('P') yang belum dicatat sebagai Ibu Hamil
        $penduduks = Penduduk::where('jenis_kelamin', 'P')
                             ->whereDoesntHave('ibuHamil') // Memastikan belum ada record aktif
                             ->select('id', 'nik', 'nama_lengkap')
                             ->orderBy('nama_lengkap')
                             ->get();
                             
        // NILAI ENUM/INPUT SESUAI MIGRASI
        $risiko = ['Rendah', 'Sedang', 'Tinggi']; 
        $golonganDarah = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

        return view('ibuhamil.create', compact('penduduks', 'risiko', 'golonganDarah'));
    }

    /**
     * Menyimpan data catatan baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id'               => 'required|exists:penduduk,id|unique:ibu_hamil,penduduk_id', 
            
            // KOLOM TANGGAL YANG BENAR
            'tanggal_mulai_hamil'       => 'required|date', 
            'tanggal_perkiraan_lahir'   => 'required|date|after_or_equal:tanggal_mulai_hamil', 
            
            // KOLOM LAIN
            'usia_kehamilan_minggu'     => 'required|integer|min:1|max:42',
            'berat_badan'               => 'nullable|numeric', 
            'tinggi_badan'              => 'nullable|numeric', 
            
            // KOLOM ENUM DAN TEXT
            'golongan_darah'            => ['required', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])],
            'risiko_kehamilan'          => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])], 
            'keterangan_lain'           => 'nullable|string|max:500', 
        ]);

        IbuHamil::create($validated); 

        return redirect()->route('ibuhamil.index')
                         ->with('success', 'Catatan Ibu Hamil berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit catatan (EDIT form)
     */
    public function edit(IbuHamil $ibuHamil)
    {
        $risiko = ['Rendah', 'Sedang', 'Tinggi'];
        $golonganDarah = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];
        
        return view('ibuhamil.edit', compact('ibuHamil', 'risiko', 'golonganDarah'));
    }

    /**
     * Memperbarui catatan (UPDATE logic)
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
        $validated = $request->validate([
            'penduduk_id'               => 'required|exists:penduduk,id|unique:ibu_hamil,penduduk_id,'.$ibuHamil->id, 
            'tanggal_mulai_hamil'       => 'required|date', 
            'tanggal_perkiraan_lahir'   => 'required|date|after_or_equal:tanggal_mulai_hamil',
            'usia_kehamilan_minggu'     => 'required|integer|min:1|max:42',
            'berat_badan'               => 'nullable|numeric', 
            'tinggi_badan'              => 'nullable|numeric', 
            'golongan_darah'            => ['nullable', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])],
            'risiko_kehamilan'          => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
            'keterangan_lain'           => 'nullable|string|max:500',
        ]);

        $ibuHamil->update($validated);

        return redirect()->route('ibuhamil.index')
                         ->with('success', 'Catatan Ibu Hamil berhasil diperbarui.');
    }

    /**
     * Menghapus catatan (DELETE)
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        $ibuHamil->delete();
        return redirect()->route('ibuhamil.index')
                         ->with('success', 'Catatan Ibu Hamil berhasil dihapus.');
    }

    /**
     * Export data ibu hamil ke Excel
     */
    public function export()
    {
        return Excel::download(
            new IbuHamilExport, 
            'data_ibu_hamil_' . date('Y-m-d_His') . '.xlsx'
        );
    }
}