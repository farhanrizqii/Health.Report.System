<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanKesehatan extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'laporan_kesehatan';
    
    protected $fillable = [
        'user_id',
        'fasilitas_kesehatan_id',
        'jenis_kegiatan',
        'deskripsi_laporan',
        'tanggal_laporan',
    ];
    
    protected $casts = [
        'tanggal_laporan' => 'date',
    ];

    // ===== RELASI =====
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasKesehatan::class, 'fasilitas_kesehatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailPenyakit()
    {
        return $this->hasMany(DetailPenyakit::class, 'laporan_kesehatan_id');
    }

    public function kegiatanPosyandu()
    {
        return $this->hasMany(KegiatanPosyandu::class, 'laporan_id');
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class, 'laporan_id');
    }
}