<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanKesehatan extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $table = 'laporan_kesehatan';
    protected $guarded = [];

    // Relasi Induk
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasKesehatan::class, 'fasilitas_kesehatan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Petugas yang mencatat
    }

    // Relasi Detail (HAS MANY)
    public function detailPenyakit() // Menggunakan camelCase
    {
        return $this->hasMany(DetailPenyakit::class, 'laporan_kesehatan_id');
    }
    public function kegiatanPosyandu()
    {
        // Asumsi Laporan Kesehatan ini adalah hasil/status dari suatu Kegiatan Posyandu
        return $this->hasMany(KegiatanPosyandu::class, 'laporan_id');
    }
    public function imunisasi()
    {
        // Asumsi Imunisasi terkait dicatat dalam Laporan ini
        return $this->hasMany(Imunisasi::class, 'laporan_id');
    }
}