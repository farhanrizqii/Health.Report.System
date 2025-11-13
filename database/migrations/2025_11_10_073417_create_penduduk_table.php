<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']); // Dibiarkan sesuai migrasi Anda: L atau P
            $table->date('tanggal_lahir');
            $table->string('alamat');
            
            // KOLOM HILANG: Golongan Darah ditambahkan
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'Tidak Tahu'])->nullable();

            // foreign key wilayah
            $table->foreignId('wilayah_id')
                ->constrained('wilayah')
                ->cascadeOnDelete();

            $table->string('no_kk')->nullable();
            $table->string('no_hp')->nullable(); // Dibiarkan sebagai no_hp
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};