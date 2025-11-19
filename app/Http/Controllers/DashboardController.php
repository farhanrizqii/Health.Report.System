<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\IbuHamil;
use App\Models\RiwayatKesehatan;
use App\Models\Wilayah;
use App\Models\KategoriPenyakit; 
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ========================================================
        // 1. METRIK KUNCI (SUMMARY BOXES)
        // ========================================================
        
        $totalPenduduk = Penduduk::count();
        $totalIbuHamilAktif = IbuHamil::count(); 
        $totalRiwayatPenyakit = RiwayatKesehatan::count();
        $totalWilayahTerdaftar = Wilayah::distinct('kelurahan')->count(); 

        // ========================================================
        // 2. DATA UNTUK GRAFIK (VISUALISASI)
        // ========================================================

        // A. Grafik 1: Perbandingan Jenis Kelamin Penduduk
        $jenisKelaminData = Penduduk::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get()
            ->map(function ($item) {
                $label = $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
                return ['label' => $label, 'total' => $item->total];
            });

        // B. Grafik 2: Top 5 Penyakit Bulan Ini (Bar Chart)
        $bulanLalu = Carbon::now()->subMonths(1);

        $topPenyakit = RiwayatKesehatan::select('penyakit_id', DB::raw('count(*) as total_kasus')) // FINAL: Menggunakan 'penyakit_id'
            ->where('created_at', '>=', $bulanLalu) 
            ->with('kategoriPenyakit')
            ->groupBy('penyakit_id') // FINAL: Menggunakan 'penyakit_id'
            ->orderByDesc('total_kasus')
            ->limit(5)
            ->get();
            
        // Memformat data untuk Chart.js (Label & Data)
        $topPenyakitLabels = $topPenyakit->map(fn($p) => $p->kategoriPenyakit->nama_penyakit ?? 'Tidak Dikenal')->toArray();
        $topPenyakitData = $topPenyakit->map(fn($p) => $p->total_kasus)->toArray();


        return view('dashboard', [
            // Metrik
            'totalPenduduk' => $totalPenduduk,
            'totalIbuHamilAktif' => $totalIbuHamilAktif,
            'totalRiwayatPenyakit' => $totalRiwayatPenyakit,
            'totalWilayahTerdaftar' => $totalWilayahTerdaftar,
            
            // Data Grafik
            'jenisKelaminData' => $jenisKelaminData,
            'topPenyakitLabels' => $topPenyakitLabels,
            'topPenyakitData' => $topPenyakitData,
        ]);
    }
}