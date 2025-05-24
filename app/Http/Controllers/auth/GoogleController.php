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
            // Get the Google user
            $googleUser = Socialite::driver('google')->user();

            // Verify we have an email
            if (empty($googleUser->email)) {
                return redirect()->route('login')
                    ->with('error', 'Google login failed - no email provided');
            }

            // Find existing user
            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                // Update Google ID if missing
                if (empty($user->google_id)) {
                    $user->google_id = $googleUser->id;
                    $user->save();
                }
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)), // More secure random password
                ]);
            }

            // Log in the user
            Auth::login($user, true); // "true" for "remember me"

            return redirect()->intended('/dashboard');

        } catch (InvalidStateException $e) {
            // Specific handling for state errors
            return redirect()->route('login')
                ->with('error', 'Session expired. Please try again.');

        } catch (\Exception $e) {
            // General error handling
            return redirect()->route('login')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
