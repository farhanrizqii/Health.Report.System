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
            $table->foreignId('laporan_kesehatan_id')->constrained('laporan_kesehatan')->cascadeOnDelete();
            $table->string('gejala')->nullable();
            $table->string('tingkat_keparahan')->nullable(); // ringan / sedang / berat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyakit');
    }
};
