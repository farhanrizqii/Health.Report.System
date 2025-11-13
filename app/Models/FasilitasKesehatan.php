<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FasilitasKesehatan extends Model
{
    use SoftDeletes;
    use HasFactory; 

    protected $table = 'fasilitas_kesehatan';
    protected $guarded = []; // Mengizinkan semua kolom diisi (termasuk nama, alamat, dll.)

    // Laporan yang tercatat di fasilitas ini
    public function laporan()
    {
        return $this->hasMany(LaporanKesehatan::class, 'fasilitas_kesehatan_id');
    }
}