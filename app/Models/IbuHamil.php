<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// HAPUS: use Illuminate\Database\Eloquent\SoftDeletes; 

class IbuHamil extends Model
{
    use HasFactory; 
    // HAPUS: use SoftDeletes; 

    protected $table = 'ibu_hamil';
    protected $guarded = []; // Mengizinkan semua kolom diisi

    /**
     * Relasi ke Penduduk (belongsTo)
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
}