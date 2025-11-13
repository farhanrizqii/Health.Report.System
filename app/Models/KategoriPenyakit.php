<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPenyakit extends Model
{
    use HasFactory;

    protected $table = 'kategori_penyakit'; 
    protected $fillable = ['nama_penyakit', 'kode_icd']; // <-- PASTIKAN FILLABLE BENAR

    /**
     * Relasi balik ke Riwayat Kesehatan (hasMany)
     */
    public function riwayatKesehatan()
    {
        return $this->hasMany(RiwayatKesehatan::class, 'kategori_penyakit_id');
    }
}