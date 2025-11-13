<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- TAMBAHKAN INI
use Illuminate\Database\Eloquent\SoftDeletes; // <-- TAMBAHKAN INI JIKA Anda menggunakannya

class Imunisasi extends Model
{
    use HasFactory; // <-- TAMBAHKAN INI

    // Jika Anda menggunakan soft delete (penghapusan lunak), aktifkan baris ini:
    // use SoftDeletes; 

    protected $table = 'imunisasi';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    /**
     * Relasi ke Penduduk (belongsTo)
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    /**
     * Relasi ke Laporan Kesehatan (belongsTo)
     */
    public function laporan()
    {
        // Pastikan kolom 'laporan_id' ada di tabel 'imunisasi'
        return $this->belongsTo(LaporanKesehatan::class, 'laporan_id');
    }
}