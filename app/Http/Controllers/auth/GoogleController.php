<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)
            ->orWhere('google_id', $googleUser->id)
            ->first();

        if (!$user) {
            // Create user but mark as needing completion
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(Str::random(24)),
                'registration_complete' => false
            ]);

            Auth::login($user);
            return redirect()->route('profile.edit')->with('info', 'Please complete your registration');
        }

        Auth::login($user);
        return redirect()->intended('/dashboard');

    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Google authentication failed.');
    }
}
}
