<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kecamatan; // <-- GANTI INI (Sesuai screenshot)
use App\Providers\RouteServiceProvider;
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
        // Panggil Model 'Kecamatan', bukan District
        $districts = Kecamatan::all();
        
        // Kita tetap pakai nama variabel $districts biar gak perlu ubah view register.blade.php
        return view('auth.register', compact('districts'));
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
            'kecamatan' => ['required'], 
            'kelurahan' => ['required'], 
        ]);

        // Cari Nama Kecamatan berdasarkan ID (Pakai Model Kecamatan)
        $kecamatanData = Kecamatan::find($request->kecamatan);
        $kecamatanName = $kecamatanData ? $kecamatanData->name : '';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'warga',
            'kecamatan' => $kecamatanName,
            'kelurahan' => $request->kelurahan,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}