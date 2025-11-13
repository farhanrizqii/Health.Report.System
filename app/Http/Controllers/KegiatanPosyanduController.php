<?php

namespace App\Http\Controllers;

use App\Models\KegiatanPosyandu;
use App\Models\Wilayah; // Diperlukan untuk dropdown
use Illuminate\Http\Request;

class KegiatanPosyanduController extends Controller
{
    /**
     * Menampilkan daftar semua kegiatan posyandu (READ)
     */
    public function index()
    {
        // Eager loading Wilayah untuk menampilkan nama wilayah
        $kegiatans = KegiatanPosyandu::with('wilayah')->orderBy('tanggal_kegiatan', 'desc')->paginate(10);
        return view('kegiatan_posyandu.index', compact('kegiatans'));
    }

    /**
     * Menampilkan form untuk menambah kegiatan baru (CREATE form)
     */
    public function create()
    {
        $wilayahs = Wilayah::orderBy('nama_wilayah')->get();
        return view('kegiatan_posyandu.create', compact('wilayahs'));
    }

    /**
     * Menyimpan data kegiatan baru (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'nama_kegiatan' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i', // Format jam (misal: 08:00)
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'deskripsi' => 'nullable|string',
        ]);

        KegiatanPosyandu::create($request->all());

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil dijadwalkan.');
    }

    /**
     * Menampilkan form untuk mengedit kegiatan (EDIT form)
     */
    public function edit(KegiatanPosyandu $kegiatanPosyandu)
    {
        $wilayahs = Wilayah::orderBy('nama_wilayah')->get();
        return view('kegiatan_posyandu.edit', compact('kegiatanPosyandu', 'wilayahs'));
    }

    /**
     * Memperbarui data kegiatan (UPDATE logic)
     */
    public function update(Request $request, KegiatanPosyandu $kegiatanPosyandu)
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'nama_kegiatan' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatanPosyandu->update($request->all());

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil diperbarui.');
    }

    /**
     * Menghapus kegiatan (DELETE)
     */
    public function destroy(KegiatanPosyandu $kegiatanPosyandu)
    {
        // Pengecekan profesional: Jangan hapus jika sudah ada laporan terkait
        if ($kegiatanPosyandu->laporan()->exists()) {
             return redirect()->route('kegiatan-posyandu.index')
                             ->with('error', 'Tidak dapat menghapus kegiatan ini karena sudah terkait dengan Laporan Kesehatan.');
        }

        $kegiatanPosyandu->delete();

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil dihapus.');
    }
}