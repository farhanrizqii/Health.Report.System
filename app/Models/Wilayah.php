<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// HAPUS: use Illuminate\Database\Eloquent\SoftDeletes; 

class Wilayah extends Model
{
    use HasFactory; 
    // HAPUS: use SoftDeletes; 

    protected $table = 'wilayah';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    /**
     * Relasi ke Wilayah Anak (Hierarki)
     */
    public function children()
    {
        return $this->hasMany(Wilayah::class, 'parent_id');
    }

    /**
     * Relasi ke Wilayah Induk (Hierarki)
     */
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'parent_id');
    }

    /**
     * Relasi ke Penduduk
     */
    public function penduduks() 
    {
        return $this->hasMany(Penduduk::class, 'wilayah_id'); 
    }

    /**
     * Relasi ke Kegiatan Posyandu
     */
    public function kegiatanPosyandu()
    {
        return $this->hasMany(KegiatanPosyandu::class, 'wilayah_id');
    }
}