<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'penduduk';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    /**
     * Relasi ke Wilayah (belongsTo)
     */
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    /**
     * Relasi ke Riwayat Kesehatan (hasMany)
     */
    public function riwayatKesehatan() // Diubah ke bentuk tunggal/camelCase untuk konsistensi
    {
        return $this->hasMany(RiwayatKesehatan::class, 'penduduk_id');
    }

    /**
     * Relasi ke Imunisasi (hasMany)
     */
    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class, 'penduduk_id');
    }

    /**
     * Relasi ke Laporan Kesehatan (hasMany)
     */
    public function laporanKesehatan() // Diubah ke bentuk yang lebih jelas
    {
        return $this->hasMany(LaporanKesehatan::class, 'penduduk_id');
    }

    /**
     * Relasi ke Ibu Hamil (hasOne)
     */
    public function ibuHamil()
    {
        return $this->hasOne(IbuHamil::class, 'penduduk_id');
    }
}