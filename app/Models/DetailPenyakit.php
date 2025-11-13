<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenyakit extends Model
{
    use HasFactory;
    
    protected $table = 'detail_penyakit';
    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(LaporanKesehatan::class, 'laporan_kesehatan_id');
    }

    public function kategoriPenyakit() // Menggunakan camelCase
    {
        return $this->belongsTo(KategoriPenyakit::class, 'kategori_penyakit_id');
    }
    
    public function penduduk() // Detail penyakit harus tahu penduduk mana yang terinfeksi
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
}