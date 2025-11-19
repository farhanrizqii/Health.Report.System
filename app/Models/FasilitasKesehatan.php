<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Baris ini dihapus: use Illuminate\Database\Eloquent\SoftDeletes;

class FasilitasKesehatan extends Model
{
    // Hapus: use SoftDeletes;
    use HasFactory; 

    protected $table = 'fasilitas_kesehatan';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    // Laporan yang tercatat di fasilitas ini
    public function laporan()
    {
        return $this->hasMany(LaporanKesehatan::class, 'fasilitas_kesehatan_id');
    }
}