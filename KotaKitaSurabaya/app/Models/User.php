<?php

namespace App\Models;

// 1. Import MustVerifyEmail
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// 2. HAPUS 'implements JWTSubject'
// Cukup 'implements MustVerifyEmail' saja untuk sekarang
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Jika di database kamu SUDAH ada kolom kecamatan/kelurahan, aktifkan baris ini:
        // 'kecamatan_id',
        // 'kelurahan_id',
        // 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // NOTE: Fungsi-fungsi JWT (getJWTIdentifier, dll) SAYA HAPUS DULU
    // karena library-nya belum diinstall. Nanti kalau sudah install JWT, baru ditambahin lagi.
}