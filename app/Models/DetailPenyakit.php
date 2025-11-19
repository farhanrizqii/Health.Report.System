<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenyakit extends Model
{
    use HasFactory;
    
    protected $table = 'detail_penyakit';
    protected $guarded = [];

    // PERBAIKAN KRITIS: Memaksa Foreign Keys dan Angka menjadi integer
    protected $casts = [
        'laporan_kesehatan_id' => 'integer',
        'kategori_penyakit_id' => 'integer',
        'penduduk_id' => 'integer',
        'jumlah_kasus' => 'integer',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanKesehatan::class, 'laporan_kesehatan_id');
    }

    public function kategoriPenyakit()
    {
        return $this->belongsTo(KategoriPenyakit::class, 'kategori_penyakit_id');
    }
    
    public function penduduk() 
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
}