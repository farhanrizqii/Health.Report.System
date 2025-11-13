<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // --- RELATIONS ---

    /**
     * Role user (admin, kader, petugas, dll)
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Jika user bisa input laporan kesehatan
     */
    public function laporanKesehatan()
    {
        return $this->hasMany(LaporanKesehatan::class, 'user_id');
    }

    /**
     * Jika user bisa input imunisasi
     */
    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class, 'user_id');
    }

    /**
     * Jika user bisa input kegiatan posyandu
     */
    public function kegiatanPosyandu()
    {
        return $this->hasMany(KegiatanPosyandu::class, 'user_id');
    }
    
    // --- ACCESSOR FOR AUTHORIZATION (PENTING!) ---

    /**
     * Accessor untuk mendapatkan nama role, krusial untuk RoleMiddleware
     * Digunakan sebagai $user->role_name
     */
    public function getRoleNameAttribute()
    {
        // Mengambil dari kolom 'nama_role' (sesuai migrasi roles)
        return $this->role->nama_role ?? null; 
    }
}