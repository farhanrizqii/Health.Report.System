<?php

namespace App\Http\Controllers;

use App\Models\LaporanKesehatan;
use App\Models\FasilitasKesehatan;
use App\Models\KategoriPenyakit;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKesehatanExport;

class LaporanKesehatanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan (READ - Index) dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = LaporanKesehatan::with(['fasilitas', 'user'])
                                    ->orderBy('tanggal_laporan', 'desc');

        // LOGIKA PENCARIAN
        if ($request->search) {
            $search = $request->search;
            $query->where('jenis_kegiatan', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('fasilitas', function ($q) use ($search) {
                      $q->where('nama_faskes', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'LIKE', '%' . $search . '%');
                  });
        }
        
        $laporans = $query->paginate(10)->withQueryString();
        return view('laporan_kesehatan.index', compact('laporans'));
    }

    /**
     * Menampilkan detail laporan (SHOW).
     */
    public function show(LaporanKesehatan $laporanKesehatan)
    {
        $laporanKesehatan->load(['fasilitas', 'user', 'detailPenyakit.kategoriPenyakit', 'detailPenyakit.penduduk']);
        return view('laporan_kesehatan.show', compact('laporanKesehatan'));
    }

    /**
     * Menampilkan form untuk menambah laporan baru (CREATE form).
     */
    public function create()
    {
        $fasilitas = FasilitasKesehatan::orderBy('nama_faskes')->get();
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->get();
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();

        return view('laporan_kesehatan.create', compact('fasilitas', 'penyakits', 'penduduks'));
    }

    /**
     * Menyimpan laporan Induk dan Detail (CREATE logic).
     */
    public function store(Request $request)
    {
        // 🚨 TIPE DATA: Konversi eksplisit ID menjadi INTEGER
        if ($request->has('detail')) {
            $details = $request->detail;
            foreach ($details as $key => $detail) {
                if (isset($detail['kategori_penyakit_id'])) {
                    $details[$key]['kategori_penyakit_id'] = (int)$detail['kategori_penyakit_id'];
                }
                if (isset($detail['penduduk_id'])) {
                    $details[$key]['penduduk_id'] = (int)$detail['penduduk_id'];
                }
                if (isset($detail['jumlah_kasus'])) {
                    $details[$key]['jumlah_kasus'] = (int)$detail['jumlah_kasus'];
                }
            }
            $request->merge(['detail' => $details]);
        }
        
        // 1. Validasi Data Induk dan Detail (Array) - KETAT
        $validated = $request->validate([
            'tanggal_laporan' => 'required|date',
            'fasilitas_kesehatan_id' => 'required|integer|exists:fasilitas_kesehatan,id',
            'jenis_kegiatan' => 'required|string|max:150', 
            'deskripsi_laporan' => 'required|string|max:1000',
            
            'detail' => 'required|array|min:1', 
            'detail.*.kategori_penyakit_id' => 'required|integer|exists:kategori_penyakit,id', 
            'detail.*.penduduk_id' => 'required|integer|exists:penduduk,id', 
            'detail.*.jumlah_kasus' => 'required|integer|min:1',
            'detail.*.keterangan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan Laporan Kesehatan (Induk)
            $laporan = LaporanKesehatan::create([
                'tanggal_laporan' => $validated['tanggal_laporan'],
                'fasilitas_kesehatan_id' => $validated['fasilitas_kesehatan_id'],
                'jenis_kegiatan' => $validated['jenis_kegiatan'],
                'deskripsi_laporan' => $validated['deskripsi_laporan'],
                'user_id' => Auth::id(),
            ]);

            // 3. Simpan Detail Penyakit
            foreach ($validated['detail'] as $detail) {
                $laporan->detailPenyakit()->create([
                    'kategori_penyakit_id' => $detail['kategori_penyakit_id'],
                    'penduduk_id' => $detail['penduduk_id'], 
                    'jumlah_kasus' => $detail['jumlah_kasus'],
                    'keterangan' => $detail['keterangan'],
                ]);
            }

            DB::commit();
            return redirect()->route('laporan-kesehatan.index')->with('success', 'Laporan Kesehatan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal menyimpan laporan. Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit laporan (EDIT form).
     */
    public function edit(LaporanKesehatan $laporanKesehatan)
    {
        $laporanKesehatan->load(['fasilitas', 'detailPenyakit']); 

        $fasilitas = FasilitasKesehatan::orderBy('nama_faskes')->get();
        $penyakits = KategoriPenyakit::orderBy('nama_penyakit')->get();
        $penduduks = Penduduk::select('id', 'nik', 'nama_lengkap')->orderBy('nama_lengkap')->get();

        return view('laporan_kesehatan.edit', compact('laporanKesehatan', 'fasilitas', 'penyakits', 'penduduks'));
    }

    /**
     * Memperbarui laporan Induk (UPDATE logic).
     */
    public function update(Request $request, LaporanKesehatan $laporanKesehatan)
    {
        $validated = $request->validate([
            'tanggal_laporan' => 'required|date',
            'fasilitas_kesehatan_id' => 'required|exists:fasilitas_kesehatan,id',
            'jenis_kegiatan' => 'required|string|max:150', 
            'deskripsi_laporan' => 'required|string|max:1000',
        ]);
        
        $laporanKesehatan->update($validated);

        return redirect()->route('laporan-kesehatan.index')->with('success', 'Laporan Kesehatan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan (Soft Delete).
     */
    public function destroy(LaporanKesehatan $laporanKesehatan)
    {
        $laporanKesehatan->delete(); 
        
        return redirect()->route('laporan-kesehatan.index')->with('success', 'Laporan Kesehatan berhasil diarsipkan (Soft Deleted).');
    }
    
    /**
     * Men-trigger ekspor data laporan kesehatan ke Excel.
     */
    public function export()
    {
        $filename = 'Laporan_Kesehatan_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new LaporanKesehatanExport(), $filename);
    }
}