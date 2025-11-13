<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;
use App\Models\FasilitasKesehatan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WilayahFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Catatan: Asumsi Model menggunakan $guarded = []
        
        // =======================================================
        // 1. DATA WILAYAH (Memastikan semua data yang dibutuhkan ada)
        // =======================================================

        // ID 1: Wilayah Induk Kelurahan Harapan Jaya
        $kelurahan_1 = Wilayah::create([
            'kelurahan' => 'Kelurahan Harapan Jaya',
            'rw' => null,
            'rt' => null,
            'parent_id' => null,
        ]);

        // ID 2: Child (RT 005) - Ini yang dicari PendudukSeeder
        Wilayah::create([
            'kelurahan' => 'Kelurahan Harapan Jaya',
            'rw' => '001',
            'rt' => '005', 
            'parent_id' => $kelurahan_1->id,
        ]);
        
        // ID 3: Wilayah Lain - Ini yang dicari PendudukSeeder
        Wilayah::create([
            'kelurahan' => 'Desa Makmur Sejati', 
            'rw' => '002', 
            'rt' => '001', 
            'parent_id' => null,
        ]);

        // =======================================================
        // 2. DATA FASILITAS KESEHATAN (Sesuai nama kolom faskes)
        // =======================================================
        $fasilitas = [
            [
                'nama_faskes' => 'Puskesmas Utama Kota', 
                'jenis_faskes' => 'Puskesmas', 
                'alamat' => 'Jl. Kesehatan No. 10',
                'kontak' => '021123456'
            ],
            [
                'nama_faskes' => 'Posyandu Anggrek', 
                'jenis_faskes' => 'Posyandu', 
                'alamat' => 'Lingkungan Sari Indah RT 05',
                'kontak' => '081223344'
            ],
        ];

        foreach ($fasilitas as $f) {
            FasilitasKesehatan::create($f);
        }
    }
}