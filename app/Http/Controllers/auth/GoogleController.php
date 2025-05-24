<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;  // Added correct Log facade
use Intervention\Image\Facades\Image;  // Added Image facade

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)
                ->orWhere('google_id', $googleUser->id)
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(24)),
                    'registration_complete' => false,
                    'profile_photo_path' => $googleUser->avatar ? $this->storeGooglePhoto($googleUser->avatar) : null,
                ]);
            }

            Auth::login($user);
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed.');
        }
    }

    protected function storeGooglePhoto($avatarUrl)
    {
        try {
            $contents = file_get_contents($avatarUrl);
            $filename = 'profile-photos/' . Str::uuid() . '.jpg';
            Storage::disk('public')->put($filename, $contents);
            return $filename;
        } catch (\Exception $e) {
            return null;
        }
    }
}
