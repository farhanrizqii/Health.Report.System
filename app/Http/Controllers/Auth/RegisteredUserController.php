<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Memberikan role_id default (Penting: Ganti 3 dengan ID role default yang benar)
        $defaultRoleId = 3; 
        $user->role_id = $defaultRoleId;
        $user->save();
        
        event(new Registered($user));

        // Hapus baris Auth::login($user); untuk mencegah login otomatis.

        // Mengarahkan user ke halaman login dengan pesan sukses.
        return redirect(route('login'))->with('status', 'Pendaftaran berhasil! Silakan masuk menggunakan akun Anda.');
    }
}