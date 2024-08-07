<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class GogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->id)->first();

            // Instead of converting the entire object, use its properties
            $content = 'Google User: ' . $google_user->getName() . ' (' . $google_user->getEmail() . ')';

            $response = new Response($content);

            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                ]);

                Auth::login($new_user);

                return redirect()->intended('home');
            } else {
                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            dd("Something went wrong: " . $th->getMessage());
        }
    }
}
