<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();
        $redirectPath = $user->role === 'admin' ? '/admin/dashboard' : '/dashboard';
        
        return $user->hasVerifiedEmail()
                    ? redirect()->intended($redirectPath)
                    : view('auth.verify-email');
    }
}
