<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPenyakit;

class KategoriPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakit = [
            ['nama_penyakit' => 'ISPA', 'kode_icd' => 'J06.9'],
            ['nama_penyakit' => 'Demam Berdarah (DBD)', 'kode_icd' => 'A91'],
            ['nama_penyakit' => 'Hipertensi', 'kode_icd' => 'I10'],
            ['nama_penyakit' => 'Diabetes Melitus (DM)', 'kode_icd' => 'E11.9'],
            ['nama_penyakit' => 'Diare', 'kode_icd' => 'A09'],
        ];

        foreach ($penyakit as $p) {
            KategoriPenyakit::create($p);
        }
    }
}