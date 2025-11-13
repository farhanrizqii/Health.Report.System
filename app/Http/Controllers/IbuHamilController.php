<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IbuHamilController extends Controller
{
    /**
     * Menampilkan daftar semua data ibu hamil (READ)
     */
    public function index()
    {
        // Ambil data Ibu Hamil beserta detail Penduduk
        $ibuHamils = IbuHamil::with('penduduk')->orderBy('tanggal_mulai_hamil', 'desc')->paginate(10);
        return view('ibuhamil.index', compact('ibuHamils'));
    }

    /**
     * Menampilkan form untuk menambah catatan baru (CREATE form)
     */
    public function create()
    {
        // Ambil hanya penduduk perempuan yang belum dicatat sebagai Ibu Hamil
        $penduduks = Penduduk::where('jenis_kelamin', 'Perempuan')
                             ->whereDoesntHave('ibuHamil') // Memastikan belum ada di tabel IbuHamil
                             ->select('id', 'nik', 'nama_lengkap')
                             ->orderBy('nama_lengkap')
                             ->get();
                             
        $risiko = ['Rendah', 'Sedang', 'Tinggi'];
        $golonganDarah = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

        return view('ibuhamil.create', compact('penduduks', 'risiko', 'golonganDarah'));
    }

    /**
     * Menyimpan data catatan baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id'               => 'required|exists:penduduk,id|unique:ibu_hamil,penduduk_id', // CEK UNIK PENTING
            'tanggal_mulai_hamil'       => 'required|date',
            'usia_kehamilan_minggu'     => 'required|integer|min:1|max:42',
            'tanggal_perkiraan_lahir'   => 'required|date|after_or_equal:tanggal_mulai_hamil',
            'golongan_darah'            => ['required', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])],
            'risiko_kehamilan'          => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
            'keterangan_lain'           => 'nullable|string|max:500',
        ]);

        IbuHamil::create($request->all());

        return redirect()->route('ibuhamil.index')
                         ->with('success', 'Catatan Ibu Hamil berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit catatan (EDIT form)
     */
    public function edit(IbuHamil $ibuHamil)
    {
        // Untuk form edit, kita hanya perlu data ibu hamil yang sedang diedit. 
        // Dropdown penduduk tidak diperlukan karena penduduk_id biasanya tidak diubah saat edit.
        $risiko = ['Rendah', 'Sedang', 'Tinggi'];
        $golonganDarah = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

        return view('ibuhamil.edit', compact('ibuHamil', 'risiko', 'golonganDarah'));
    }

    /**
     * Memperbarui catatan (UPDATE logic)
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
        $request->validate([
            // CEK UNIK, kecuali ID IbuHamil yang sedang diedit
            'penduduk_id'               => 'required|exists:penduduk,id|unique:ibu_hamil,penduduk_id,'.$ibuHamil->id, 
            'tanggal_mulai_hamil'       => 'required|date',
            'usia_kehamilan_minggu'     => 'required|integer|min:1|max:42',
            'tanggal_perkiraan_lahir'   => 'required|date|after_or_equal:tanggal_mulai_hamil',
            'golongan_darah'            => ['required', Rule::in(['A', 'B', 'AB', 'O', 'Tidak Tahu'])],
            'risiko_kehamilan'          => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
            'keterangan_lain'           => 'nullable|string|max:500',
        ]);

        $ibuHamil->update($request->all());

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
}