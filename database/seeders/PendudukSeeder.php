<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\Wilayah; 

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil ID Wilayah secara dinamis (AMAN)
        
        // Ambil ID Wilayah untuk Harapan Jaya RT 005
        $wilayah_harapan_jaya = Wilayah::where('kelurahan', 'Kelurahan Harapan Jaya')
                                       ->where('rt', '005') 
                                       ->first(); 
        
        // Ambil ID Wilayah untuk Desa Makmur Sejati
        $wilayah_makmur_sejati = Wilayah::where('kelurahan', 'Desa Makmur Sejati')
                                        ->first();
        
        // Pengecekan Kritis: Jika gagal mengambil ID, hentikan dan tampilkan pesan
        if (!$wilayah_harapan_jaya || !$wilayah_makmur_sejati) {
             throw new \Exception("Gagal menemukan ID Wilayah di PendudukSeeder. Pastikan WilayahFasilitasSeeder dijalankan dan datanya lengkap.");
        }
        
        // Ambil ID-nya
        $id_harapan_jaya = $wilayah_harapan_jaya->id;
        $id_makmur_sejati = $wilayah_makmur_sejati->id;

        // 2. Data Penduduk
        $data = [
            // Penduduk Pria (wilayah ID Harapan Jaya RT 005)
            [
                'nik' => '1271010101900001',
                'nama_lengkap' => 'Budi Santoso',
                'jenis_kelamin' => 'L', 
                'tanggal_lahir' => '1990-01-01',
                'golongan_darah' => 'O', 
                'alamat' => 'Jalan Merdeka No. 10',
                'no_hp' => '08123456789',
                'wilayah_id' => $id_harapan_jaya, 
            ],
            // Penduduk Wanita, Potensial Ibu Hamil (wilayah ID Desa Makmur Sejati)
            [
                'nik' => '1271020202950002',
                'nama_lengkap' => 'Siti Aisyah',
                'jenis_kelamin' => 'P', 
                'tanggal_lahir' => '1995-02-02',
                'golongan_darah' => 'A', 
                'alamat' => 'Desa Makmur Sejati RT 01',
                'no_hp' => '08112233445',
                'wilayah_id' => $id_makmur_sejati, 
            ],
            // Penduduk Pria - Anak (wilayah ID Harapan Jaya RT 005)
            [
                'nik' => '1271030303200003',
                'nama_lengkap' => 'Rizky Pratama',
                'jenis_kelamin' => 'L', 
                'tanggal_lahir' => '2020-03-03',
                'golongan_darah' => 'B', 
                'alamat' => 'Jalan Anak Sehat No. 5',
                'no_hp' => null,
                'wilayah_id' => $id_harapan_jaya, 
            ],
        ];

        foreach ($data as $p) {
            Penduduk::create($p);
        }
    }
}