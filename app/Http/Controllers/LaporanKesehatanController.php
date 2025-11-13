<?php

namespace App\Http\Controllers;

use App\Models\LaporanKesehatan;
use App\Models\FasilitasKesehatan;
use App\Models\KategoriPenyakit;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan (READ)
     */
    public function index()
    {
        $laporans = LaporanKesehatan::with(['fasilitas', 'user'])
                                    ->orderBy('tanggal_laporan', 'desc')
                                    ->paginate(10);
        return view('laporan_kesehatan.index', compact('laporans'));
    }

    /**
     * Menampilkan form untuk menambah laporan baru (CREATE form)
     */
    public function create()
    {
        $fasilitas = FasilitasKesehatan::orderBy('nama_fasilitas')->get();
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->get();
        // Ambil data penduduk untuk dropdown detail penyakit
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();

        return view('laporan_kesehatan.create', compact('fasilitas', 'penyakits', 'penduduks'));
    }

    /**
     * Menyimpan laporan Induk dan Detail (CREATE logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_laporan' => 'required|date',
            'fasilitas_kesehatan_id' => 'required|exists:fasilitas_kesehatan,id',
            'jenis_kegiatan' => 'required|string', // Contoh: Surveilans, Pemeriksaan Rutin
            'deskripsi_laporan' => 'required|string|max:1000',
            // Validasi untuk Detail Penyakit
            'detail.*.kategori_penyakit_id' => 'required|exists:kategori_penyakit,id',
            'detail.*.penduduk_id' => 'required|exists:penduduk,id',
            'detail.*.jumlah_kasus' => 'required|integer|min:1',
            'detail.*.keterangan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan Laporan Kesehatan (Induk)
            $laporan = LaporanKesehatan::create([
                'tanggal_laporan' => $request->tanggal_laporan,
                'fasilitas_kesehatan_id' => $request->fasilitas_kesehatan_id,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'deskripsi_laporan' => $request->deskripsi_laporan,
                'user_id' => Auth::id(), // Petugas yang mencatat
            ]);

            // 2. Simpan Detail Penyakit (Detail)
            // Pastikan Anda menangani kasus di mana 'detail' mungkin kosong
            if ($request->has('detail')) {
                foreach ($request->detail as $detail) {
                    $laporan->detailPenyakit()->create([
                        'kategori_penyakit_id' => $detail['kategori_penyakit_id'],
                        'penduduk_id' => $detail['penduduk_id'],
                        'jumlah_kasus' => $detail['jumlah_kasus'],
                        'keterangan' => $detail['keterangan'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('laporan-kesehatan.index')->with('success', 'Laporan Kesehatan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal menyimpan laporan. Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail laporan (SHOW)
     */
    public function show(LaporanKesehatan $laporanKesehatan)
    {
        // Eager load semua relasi
        $laporanKesehatan->load(['fasilitas', 'user', 'detailPenyakit.kategoriPenyakit', 'detailPenyakit.penduduk']);
        return view('laporan_kesehatan.show', compact('laporanKesehatan'));
    }
    
    /**
     * Menghapus laporan (Soft Delete)
     */
    public function destroy(LaporanKesehatan $laporanKesehatan)
    {
        // Melakukan Soft Delete
        $laporanKesehatan->delete(); 
        
        return redirect()->route('laporan-kesehatan.index')->with('success', 'Laporan Kesehatan berhasil diarsipkan (Soft Deleted).');
    }
}