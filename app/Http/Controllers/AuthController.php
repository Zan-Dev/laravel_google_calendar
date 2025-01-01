<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar.readonly'])
            ->redirect();
    }

    public function callback(){
        $userFromGoogle = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $userFromGoogle->getEmail()],
            [
                'name' => $userFromGoogle->getName(),
                'google_id' => $userFromGoogle->getId(),
                'avatar' => $userFromGoogle->getAvatar(),
                'access_token' => $userFromGoogle->token,
                'google_refresh_token' => $userFromGoogle->refreshToken,
            ]);

        Auth::login($user);
        session()->regenerate();
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
