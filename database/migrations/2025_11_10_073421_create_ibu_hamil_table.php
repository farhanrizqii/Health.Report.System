<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();
            
            // KOLOM TANGGAL DITAMBAHKAN KEMBALI
            $table->date('tanggal_mulai_hamil')->nullable(); // Tanggal mulai
            $table->date('tanggal_perkiraan_lahir')->nullable(); // TPL

            $table->integer('usia_kehamilan_minggu');
            $table->float('berat_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            
            // PERBAIKAN NAMA: status_kehamilan menjadi risiko_kehamilan
            $table->string('risiko_kehamilan')->default('Rendah'); // Risiko rendah / sedang / tinggi

            // Tambahan lain yang hilang dari Controller
            $table->string('golongan_darah')->nullable(); 
            $table->text('keterangan_lain')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // Asumsi Anda ingin SoftDeletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil');
    }
};