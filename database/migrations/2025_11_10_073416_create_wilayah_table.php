<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan')->nullable(); // Dibiarkan sesuai kode Anda
            $table->string('rw')->nullable();
            $table->string('rt')->nullable();
            
            // Kolom Foreign Key untuk Hirarki Wilayah (Parent)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('wilayah') // Merujuk ke tabel 'wilayah' sendiri
                  ->onDelete('cascade');
                  
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};