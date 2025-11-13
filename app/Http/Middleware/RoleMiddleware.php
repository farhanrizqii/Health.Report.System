<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Asumsi model User memiliki relasi 'role' yang mengarah ke tabel Roles
        // Jika relasi Anda bernama lain, sesuaikan di sini.
        $userRole = $user->role->nama_role; 

        // 2. Cek apakah role pengguna ada dalam daftar roles yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak diizinkan, arahkan ke halaman 403 (Unauthorized) atau dashboard
        return response()->view('errors.403', [], 403);
        
        // Opsi lain: return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses.');
    }
}