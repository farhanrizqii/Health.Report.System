<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Import Controllers kustom (Data Master & CRUD)
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KategoriPenyakitController; 
use App\Http\Controllers\FasilitasKesehatanController; 
use App\Http\Controllers\KegiatanPosyanduController; 

// Import Controllers Transaksi
use App\Http\Controllers\ImunisasiController; 
use App\Http\Controllers\IbuHamilController; 
use App\Http\Controllers\RiwayatKesehatanController; 
use App\Http\Controllers\LaporanKesehatanController; 

// Import Controller Dashboard BARU
use App\Http\Controllers\DashboardController; // <-- TAMBAH

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Dashboard Route (DIUBAH untuk menggunakan Controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard'); // <-- PERUBAHAN DI SINI

    // Profile Routes (Diakses oleh SEMUA user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ==========================================================
    // --- GRUP 1: HANYA ADMIN (Manajemen Data Master Inti) ---
    // ==========================================================
    Route::middleware(['role:Admin'])->group(function () {
        
        // Data Wilayah (Master Geografis)
        Route::resource('wilayah', WilayahController::class);
        
        // Data Master Kategori Penyakit
        Route::resource('kategori-penyakit', KategoriPenyakitController::class)->names(['index' => 'kategori-penyakit.index']);
        
        // Data Master Fasilitas Kesehatan
        Route::resource('fasilitas-kesehatan', FasilitasKesehatanController::class)->names(['index' => 'fasilitas-kesehatan.index']);
        
        // Data Master Kegiatan Posyandu
        Route::resource('kegiatan-posyandu', KegiatanPosyanduController::class)->names(['index' => 'kegiatan-posyandu.index']);
    });
    
    // =========================================================================
    // --- GRUP 2: ADMIN & PETUGAS KESEHATAN (Input Data & Manajemen Penduduk) ---
    // =========================================================================
    Route::middleware(['role:Admin,Petugas Kesehatan'])->group(function () {
        
        // Data Penduduk (Dasar)
        Route::resource('penduduk', PendudukController::class);
        
        // Data Imunisasi
        Route::resource('imunisasi', ImunisasiController::class);
        
        // Data Ibu Hamil
        Route::resource('ibu-hamil', IbuHamilController::class)->names([
            'index' => 'ibuhamil.index',
            'create' => 'ibuhamil.create',
            'store' => 'ibuhamil.store',
            'show' => 'ibuhamil.show',
            'edit' => 'ibuhamil.edit',
            'update' => 'ibuhamil.update',
            'destroy' => 'ibuhamil.destroy',
        ]);
        
        // Riwayat Pencatatan Penyakit Individu
        Route::resource('riwayat-kesehatan', RiwayatKesehatanController::class)->names(['index' => 'riwayat-kesehatan.index']);
        
        // Laporan Kesehatan Induk/Detail (Dikecualikan edit/update)
        Route::resource('laporan-kesehatan', LaporanKesehatanController::class)->except(['edit', 'update']);

        // Anda dapat menambahkan batasan DELETE khusus di sini jika diperlukan
    });

});

require __DIR__.'/auth.php';