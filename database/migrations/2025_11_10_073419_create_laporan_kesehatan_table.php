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
            
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('fasilitas_kesehatan_id')->constrained('fasilitas_kesehatan')->onDelete('restrict');
            
            $table->string('jenis_kegiatan');
            $table->text('deskripsi_laporan');
            $table->date('tanggal_laporan');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kesehatan');
    }
};