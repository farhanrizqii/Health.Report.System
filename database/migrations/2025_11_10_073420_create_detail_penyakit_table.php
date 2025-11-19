<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penyakit', function (Blueprint $table) {
            $table->id();
            
            // FOREIGN KEY KE LAPORAN INDUK
            $table->foreignId('laporan_kesehatan_id')->constrained('laporan_kesehatan')->cascadeOnDelete();
            
            // TAMBAHAN KRITIS (Sesuai Controller dan Form)
            $table->foreignId('kategori_penyakit_id')->constrained('kategori_penyakit')->onDelete('restrict');
            $table->foreignId('penduduk_id')->constrained('penduduk')->onDelete('restrict');
            $table->integer('jumlah_kasus')->default(1); 
            $table->text('keterangan')->nullable(); // Menggunakan 'keterangan' sebagai kolom Keterangan Khusus

            // Kolom lama dihapus atau disederhanakan
            // $table->string('gejala')->nullable(); 
            // $table->string('tingkat_keparahan')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyakit');
    }
};