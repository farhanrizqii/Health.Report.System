<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // =============== KODE PENGECUALIAN UNTUK ROOT ('/') ===============
                // Jika user sudah login dan mencoba mengakses URL root ('/'), 
                // kita izinkan dia melihat halaman welcome (melalui $next($request))
                // tanpa me-redirect ke dashboard.
                if ($request->is('/')) {
                    return $next($request);
                }
                // =================================================================
                
                // Untuk rute otentikasi lain (e.g., /login, /register) saat logged in, 
                // tetap redirect ke RouteServiceProvider::HOME (/dashboard)
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}