<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{


    public function __construct()
    {

    }


    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // если пользователь существует, то передаем его. Если нет, то создаем нового и тоже передаем
        if (!$localUser = User::where($provider . '_id', '=', $socialUser->id)->first()) {
            $localUser = User::create([
                'name' => $socialUser->name,
                'login' => $socialUser->nickname,
                'avatar' => $socialUser->avatar,
                $provider . '_id' => $socialUser->id
            ]);
        }
        $localUser->generateToken();

        return response()->json($localUser);
    }

}
