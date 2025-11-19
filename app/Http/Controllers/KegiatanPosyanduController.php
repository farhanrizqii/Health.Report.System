<?php

namespace App\Http\Controllers;

use App\Models\KegiatanPosyandu;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KegiatanPosyanduExport;

class KegiatanPosyanduController extends Controller
{
    /**
     * Menampilkan daftar semua kegiatan posyandu (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        // PERBAIKAN: Mengurutkan berdasarkan kolom 'tanggal' yang ada di DB
        $query = KegiatanPosyandu::with('wilayah')->orderBy('tanggal', 'desc');

        // LOGIKA PENCARIAN
        if ($request->search) {
            $search = $request->search;
            $query->where('jenis_kegiatan', 'LIKE', '%' . $search . '%') // Mencari berdasarkan jenis_kegiatan
                  ->orWhereHas('wilayah', function ($q) use ($search) {
                      $q->where('kelurahan', 'LIKE', '%' . $search . '%')
                        ->orWhere('rt', 'LIKE', '%' . $search . '%')
                        ->orWhere('rw', 'LIKE', '%' . $search . '%');
                  });
        }

        $kegiatans = $query->paginate(10)->withQueryString();
        return view('kegiatan_posyandu.index', compact('kegiatans'));
    }

    /**
     * Menampilkan form untuk menambah kegiatan baru (CREATE form)
     */
    public function create()
    {
        // Mengurutkan berdasarkan kolom 'kelurahan' yang ada di DB
        $wilayahs = Wilayah::orderBy('kelurahan')->get(); 
        return view('kegiatan_posyandu.create', compact('wilayahs'));
    }

    /**
     * Menyimpan data kegiatan baru (CREATE logic)
     */
    public function store(Request $request)
    {
        // VALIDASI TOTAL SESUAI MIGRASI (tanpa waktu_mulai/waktu_selesai)
        $validated = $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'jenis_kegiatan' => 'required|string|max:255', // Menggunakan kolom jenis_kegiatan
            'tanggal' => 'required|date', // Menggunakan kolom tanggal
            'jumlah_peserta' => 'nullable|integer', 
            'keterangan' => 'nullable|string', // Menggunakan kolom keterangan
        ]);

        KegiatanPosyandu::create($validated);

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil dijadwalkan.');
    }
    
    /**
     * Menampilkan detail satu kegiatan (READ - Show)
     */
    public function show(KegiatanPosyandu $kegiatanPosyandu)
    {
        $kegiatanPosyandu->load('wilayah');
        return view('kegiatan_posyandu.show', compact('kegiatanPosyandu'));
    }

    /**
     * Menampilkan form untuk mengedit kegiatan (EDIT form)
     */
    public function edit(KegiatanPosyandu $kegiatanPosyandu)
    {
        $wilayahs = Wilayah::orderBy('kelurahan')->get();
        return view('kegiatan_posyandu.edit', compact('kegiatanPosyandu', 'wilayahs'));
    }

    /**
     * Memperbarui data kegiatan (UPDATE logic)
     */
    public function update(Request $request, KegiatanPosyandu $kegiatanPosyandu)
    {
        // VALIDASI TOTAL SESUAI MIGRASI
        $validated = $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'jenis_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah_peserta' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $kegiatanPosyandu->update($validated);

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil diperbarui.');
    }

    /**
     * Menghapus kegiatan (DELETE)
     */
    public function destroy(KegiatanPosyandu $kegiatanPosyandu)
    {
        if ($kegiatanPosyandu->laporan()->exists()) {
             return redirect()->route('kegiatan-posyandu.index')
                             ->with('error', 'Tidak dapat menghapus kegiatan ini karena sudah terkait dengan Laporan Kesehatan.');
        }

        $kegiatanPosyandu->delete();

        return redirect()->route('kegiatan-posyandu.index')
                         ->with('success', 'Kegiatan Posyandu berhasil dihapus.');
    }

    /**
     * Export data kegiatan posyandu ke Excel
     */
    public function export()
    {
        $filename = 'Kegiatan_Posyandu_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new KegiatanPosyanduExport(), $filename);
    }
}