<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        $google_user = Socialite::driver('google')->user();

        $user = User::where('google_id', $google_user->getId())->first();

        if (!$user) {
            $newUser = new User([
                'google_id' => $google_user->getId(),
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'password' => Hash::make($this->generateRandomString(10)),
                'type' => 'A'
            ]);

            $newUser->save();

            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/');
        }

        auth('web')->login($user);
        session()->regenerate();

        return redirect('/');
    }

    public function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback() {
        try {
            $facebook_user = Socialite::driver('facebook')->user();

            $user = User::where('facebook_id', $facebookUser->id)->first();
            if (!$user) {
                $newUser = new User([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => Hash::make($this->generateRandomString(10)),
                    'type' => 'A'
                ]);

                $newUser->save();

                auth('web')->login($newUser);
                session()->regenerate();

                return redirect('/');
            }

            auth()->login($user, true);
            return redirect()->to('/home');

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to login with Facebook.');
        }
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
