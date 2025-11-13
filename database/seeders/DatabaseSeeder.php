<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // PENTING: Matikan pengecekan Foreign Key untuk proses TRUNCATE yang aman
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate(); 

        $this->call([
            // --- Otorisasi dan Data Master ---
            RoleSeeder::class, 
            KategoriPenyakitSeeder::class,
            WilayahFasilitasSeeder::class, 
            PendudukSeeder::class, 
            
            // TAMBAHAN: Riwayat Kesehatan harus dijalankan setelah semua master
            RiwayatKesehatanSeeder::class, // <-- TAMBAH PEMANGGILAN SEEDER BARU INI
        ]);

        // --- PEMBUATAN USER ---
        $adminRole = Role::where('nama_role', 'Admin')->first();
        $petugasRole = Role::where('nama_role', 'Petugas Kesehatan')->first();

        // 1. Buat User Admin
        User::create([
            'name' => 'Administrator Puskesmas',
            'email' => 'admin@health.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id ?? 1, 
        ]);
        
        // 2. Buat User Petugas
        User::create([
            'name' => 'Petugas Bidan Desa',
            'email' => 'petugas@health.com',
            'password' => bcrypt('password'), 
            'role_id' => $petugasRole->id ?? 2,
        ]);
        
        // Nyalakan kembali pengecekan Foreign Key
        Schema::enableForeignKeyConstraints();
    }
}