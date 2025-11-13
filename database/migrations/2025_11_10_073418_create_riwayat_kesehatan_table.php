<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_kesehatan', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke penduduk (menggunakan foreignId untuk konsistensi)
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();

            // TAMBAHAN KRITIS: Foreign Key ke Kategori Penyakit
            $table->foreignId('penyakit_id')->constrained('kategori_penyakit')->cascadeOnDelete(); // Kolom yang hilang

            // Detail riwayat
            $table->string('jenis_pemeriksaan'); 
            $table->text('hasil')->nullable(); 
            $table->text('tindakan')->nullable();
            $table->date('tanggal_pemeriksaan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kesehatan');
    }
};