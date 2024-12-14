<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $userFromGoogle = Socialite::driver('google')->user();

        $userFromDB = User::where('email', $userFromGoogle->getEmail())->first();

        if(!$userFromDB){
            $userFromDB = new User();
            $userFromDB->name = $userFromGoogle->getName();
            $userFromDB->email = $userFromGoogle->getEmail();
            $userFromDB->google_id = $userFromGoogle->getId();

            $userFromDB->save();

            auth('web')->login($userFromDB);
            session()->regenerate();
            return redirect()->route('/');
        }
        auth('web')->login($userFromDB);
        session()->regenerate();
        return redirect('/');
    }

    public function logout(Request $request){
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
