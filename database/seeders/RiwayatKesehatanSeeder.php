<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatKesehatan;
use App\Models\Penduduk;
use App\Models\KategoriPenyakit; 

class RiwayatKesehatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil ID yang sudah ada dari seeder sebelumnya (PENTING!)
        $penduduk_budi = Penduduk::where('nama_lengkap', 'Budi Santoso')->first();
        $penduduk_fatma = Penduduk::where('nama_lengkap', 'Fatmawati')->first(); // Ambil user lansia jika ada
        $penyakit_dbd = KategoriPenyakit::where('nama_penyakit', 'Demam Berdarah (DBD)')->first();
        $penyakit_hipertensi = KategoriPenyakit::where('nama_penyakit', 'Hipertensi')->first();

        // Pengecekan keamanan
        if (!$penduduk_budi || !$penyakit_dbd) {
             echo "Peringatan: Gagal menemukan data Penduduk atau Penyakit. Riwayat Kesehatan Seeder dilewati.\n";
             return;
        }

        // 2. Insert data Riwayat Kesehatan
        
        // Kasus 1: Budi terkena DBD
        RiwayatKesehatan::create([
            'penduduk_id' => $penduduk_budi->id,
            'penyakit_id' => $penyakit_dbd->id, // FINAL: Menggunakan kunci yang benar (penyakit_id)
            'jenis_pemeriksaan' => 'Diagnosa Cepat',
            'hasil' => 'Positif Dengue',
            'tindakan' => 'Rawat Jalan',
            'tanggal_pemeriksaan' => now()->subDays(10),
        ]);
        
        // Kasus 2: Fatmawati terkena Hipertensi
        if ($penduduk_fatma && $penyakit_hipertensi) {
            RiwayatKesehatan::create([
                'penduduk_id' => $penduduk_fatma->id,
                'penyakit_id' => $penyakit_hipertensi->id, // FINAL: Menggunakan kunci yang benar (penyakit_id)
                'jenis_pemeriksaan' => 'Cek Rutin',
                'hasil' => 'Tekanan darah tinggi',
                'tindakan' => 'Pemberian obat Amlodipin',
                'tanggal_pemeriksaan' => now()->subMonths(2),
            ]);
        }
    }
}