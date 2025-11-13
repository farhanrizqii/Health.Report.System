<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Matikan FK check & Kosongkan tabel roles
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        
        // 2. Gunakan SQL mentah (DB::statement) untuk menjamin string dikuotasi
        //    dan menggunakan nama kolom yang BENAR: 'nama_role'
        $timestamp = now()->toDateTimeString();

        DB::statement("
            INSERT INTO `roles` (`id`, `nama_role`, `created_at`, `updated_at`) 
            VALUES 
            (1, 'Admin', '{$timestamp}', '{$timestamp}'), 
            (2, 'Petugas Kesehatan', '{$timestamp}', '{$timestamp}'), 
            (3, 'Kepala Dinas', '{$timestamp}', '{$timestamp}')
        ");
        
        // 3. Nyalakan kembali FK check
        Schema::enableForeignKeyConstraints();
    }
}