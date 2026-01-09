<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
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
            'kecamatan_id' => ['required', 'exists:kecamatans,id'], 
            'kelurahan_id' => ['required', 'exists:kelurahans,id'], 
        ]);

        // Verifikasi bahwa kelurahan benar-benar milik kecamatan yang dipilih
        $kelurahan = Kelurahan::find($request->kelurahan_id);
        if (!$kelurahan || $kelurahan->kecamatan_id != $request->kecamatan_id) {
            return back()->withErrors(['kelurahan_id' => 'Kelurahan yang dipilih tidak sesuai dengan kecamatan.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Sesuai dengan enum di migration: 'user' atau 'admin'
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}