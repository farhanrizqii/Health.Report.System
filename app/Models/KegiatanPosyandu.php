<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KegiatanPosyandu extends Model
{
    use HasFactory;
    
    protected $table = 'kegiatan_posyandu';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    /**
     * Relasi ke Laporan Kesehatan (belongsTo)
     */
    public function laporan()
    {
        return $this->belongsTo(LaporanKesehatan::class, 'laporan_id');
    }

    /**
     * Relasi ke Wilayah (belongsTo)
     */
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }
}