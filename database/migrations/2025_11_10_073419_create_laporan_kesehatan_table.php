<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();
            $table->foreignId('kategori_penyakit_id')->nullable()->constrained('kategori_penyakit');
            $table->foreignId('fasilitas_kesehatan_id')->nullable()->constrained('fasilitas_kesehatan');
            $table->date('tanggal_laporan');
            $table->string('status')->default('aktif'); // aktif, sembuh, meninggal
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kesehatan');
    }
};
