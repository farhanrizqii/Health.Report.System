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
use App\Http\Controllers\DashboardController; 

// Import Middleware Role
use App\Http\Middleware\RoleMiddleware; 


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
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    // ==========================================================
    // --- GRUP 1: ADMIN - Manajemen Data Master Inti ---
    // ==========================================================
    Route::middleware([RoleMiddleware::class . ':Admin'])->group(function () {

        // --- ROUTE EKSPOR WILAYAH HARUS DI ATAS RESOURCE ---
        Route::get('wilayah/export', [WilayahController::class, 'export'])
            ->name('wilayah.export');

        // Data Wilayah
        Route::resource('wilayah', WilayahController::class);


        // --- ROUTE EKSPOR KATEGORI PENYAKIT HARUS DI ATAS RESOURCE ---
        Route::get('kategori-penyakit/export', [KategoriPenyakitController::class, 'export'])
            ->name('kategori-penyakit.export');

        // Data Kategori Penyakit
        Route::resource('kategori-penyakit', KategoriPenyakitController::class)
            ->names(['index' => 'kategori-penyakit.index']);

        
        // --- ROUTE EKSPOR FASILITAS KESEHATAN HARUS DI ATAS RESOURCE ---
        Route::get('fasilitas-kesehatan/export', [FasilitasKesehatanController::class, 'export'])
            ->name('fasilitas-kesehatan.export');

        // Data Fasilitas Kesehatan
        Route::resource('fasilitas-kesehatan', FasilitasKesehatanController::class)
            ->names(['index' => 'fasilitas-kesehatan.index']);


        // --- ROUTE EKSPOR KEGIATAN POSYANDU HARUS DI ATAS RESOURCE ---
        Route::get('kegiatan-posyandu/export', [KegiatanPosyanduController::class, 'export'])
            ->name('kegiatan-posyandu.export');

        // Data Kegiatan Posyandu
        Route::resource('kegiatan-posyandu', KegiatanPosyanduController::class)
            ->names(['index' => 'kegiatan-posyandu.index']);
    });


    // =========================================================================
    // --- GRUP 2: ADMIN & PETUGAS KESEHATAN (Input Data Penduduk & Transaksi) ---
    // =========================================================================
    Route::middleware([RoleMiddleware::class . ':Admin,Petugas Kesehatan'])->group(function () {

        // --- ROUTE EKSPOR PENDUDUK HARUS DI ATAS RESOURCE ---
        Route::get('penduduk/export', [PendudukController::class, 'export'])
            ->name('penduduk.export');

        // Data Penduduk
        Route::resource('penduduk', PendudukController::class);

        // --- ROUTE EKSPOR IMUNISASI HARUS DI ATAS RESOURCE ---
        Route::get('imunisasi/export', [ImunisasiController::class, 'export'])
            ->name('imunisasi.export');

        // Data Imunisasi
        Route::resource('imunisasi', ImunisasiController::class);

        // --- ROUTE EKSPOR IBU HAMIL HARUS DI ATAS RESOURCE ---
        Route::get('ibu-hamil/export', [IbuHamilController::class, 'export'])
            ->name('ibuhamil.export');

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

        // Riwayat Kesehatan Individu
        Route::resource('riwayat-kesehatan', RiwayatKesehatanController::class)
            ->names(['index' => 'riwayat-kesehatan.index']);

        // --- ROUTE EKSPOR LAPORAN KESEHATAN HARUS DI ATAS RESOURCE ---
        Route::get('laporan-kesehatan/export', [LaporanKesehatanController::class, 'export'])
            ->name('laporan-kesehatan.export');

        // Laporan Kesehatan
        Route::resource('laporan-kesehatan', LaporanKesehatanController::class);
    });

});

require __DIR__.'/auth.php';