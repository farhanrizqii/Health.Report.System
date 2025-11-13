<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes; // Hapus jika tidak ada kolom deleted_at di migrasi

class RiwayatKesehatan extends Model
{
    use HasFactory;
    
    protected $table = 'riwayat_kesehatan';
    protected $guarded = [];

    /**
     * Relasi ke Penduduk (belongsTo)
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    /**
     * Relasi ke Kategori Penyakit (belongsTo)
     */
    public function kategoriPenyakit() 
    {
        // FINAL: Menggunakan kolom yang benar setelah perbaikan migrasi
        return $this->belongsTo(KategoriPenyakit::class, 'penyakit_id'); 
    }
}