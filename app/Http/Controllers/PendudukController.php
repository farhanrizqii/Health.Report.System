<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendudukController extends Controller
{
    /**
     * Menampilkan daftar semua data penduduk (READ)
     */
    public function index()
    {
        $penduduks = Penduduk::with('wilayah')->orderBy('nama_lengkap')->paginate(10);
        return view('penduduk.index', compact('penduduks'));
    }

    /**
     * Menampilkan form untuk menambah penduduk baru (CREATE form)
     */
    public function create()
    {
        $wilayahs = Wilayah::orderBy('kelurahan')->get(); // Menggunakan kolom 'kelurahan' untuk sorting
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
            'tanggal_lahir' => 'required|date',
            // Perbaikan: jenis_kelamin hanya menerima 'L' atau 'P'
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])], 
            'alamat'        => 'required|string',
            // Kolom baru
            'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])], 
            'no_hp'         => 'nullable|string|max:15', // Menggunakan 'no_hp'
            'no_kk'         => 'nullable|string|max:20', // Menggunakan 'no_kk'
        ]);

        Penduduk::create($validated);

        return redirect()->route('penduduk.index')
                         ->with('success', 'Data Penduduk baru berhasil ditambahkan.');
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
            'nik'           => 'required|string|size:16|unique:penduduk,nik,'.$penduduk->id, 
            'nama_lengkap'  => 'required|string|max:150',
            'tanggal_lahir' => 'required|date',
            // Perbaikan: jenis_kelamin hanya menerima 'L' atau 'P'
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])], 
            'alamat'        => 'required|string',
            // Kolom baru
            'golongan_darah' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])], 
            'no_hp'         => 'nullable|string|max:15', // Menggunakan 'no_hp'
            'no_kk'         => 'nullable|string|max:20', // Menggunakan 'no_kk'
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
        $penduduk->delete();
        return redirect()->route('penduduk.index')
                         ->with('success', 'Data Penduduk berhasil dihapus.');
    }
}