<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// UNTUK EMAIL
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail; 
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Untuk Lupa Password 
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Permintaan Reset Password - KotaKita Surabaya')
                ->greeting('Halo, ' . $notifiable->name . '!')
                ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
                ->action('Reset Password Saya', url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('Link reset password ini akan kadaluarsa dalam 30 detik.')
                ->line('Jika Anda tidak meminta reset password, abaikan saja email ini.')
                ->salutation('Salam, Admin KotaKita');
        });

        // Untuk Verifikasi Email
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email - KotaKita Surabaya') // Judul Email
                ->greeting('Halo, ' . $notifiable->name . '!') // Sapaan
                ->line('Terima kasih telah mendaftar di aplikasi KotaKita Surabaya.')
                ->line('Mohon verifikasi alamat email Anda dengan mengklik tombol di bawah ini untuk mengaktifkan akun.')
                ->action('Verifikasi Email Saya', $url) // Tombol Hijau
                ->line('Jika Anda tidak merasa mendaftar akun ini, Anda tidak perlu melakukan apa-apa.')
                ->salutation('Salam, Admin KotaKita');
        });
    }
}