<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit')->unique(); // Pastikan nama penyakit unik
            $table->string('kode_icd', 10)->nullable()->unique(); // <-- KOLOM YANG HILANG DITAMBAHKAN
            // $table->text('deskripsi')->nullable(); // Kolom deskripsi (Opsional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_penyakit');
    }
};