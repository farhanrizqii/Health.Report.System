<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPenyakit extends Model
{
    use HasFactory;

    protected $table = 'kategori_penyakit'; 
    protected $fillable = ['nama_penyakit', 'kode_icd'];

    /**
     * Relasi balik ke Riwayat Kesehatan (hasMany)
     */
    public function riwayatKesehatan()
    {
        // PERBAIKAN KRITIS: Menetapkan Foreign Key secara eksplisit ke 'penyakit_id'
        return $this->hasMany(RiwayatKesehatan::class, 'penyakit_id'); 
    }
}