<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonApiAuth\Traits\HasToShowApiTokens;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    use HasToShowApiTokens;
    public function __construct()
    {
        //todo mostrar alerta en el front para que cambie su contrasena por default
        $this->middleware('social');
    }

    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    public function callback($service)
    {
        $social_provider_user = Socialite::driver($service)->stateless()->user();

        $user = User::where("social_provider_id", $social_provider_user->id)->first();

        if ($user) {
            $user->update([
                "social_provider_token" => $social_provider_user->token,
                "social_provider_refresh_token" => $social_provider_user->refreshToken,
            ]);
        } else {
            $user = User::create([
                "name" => $social_provider_user->name,
                "email" => $social_provider_user->email,
                "password" => Hash::make('password'),
                "social_provider_id" => $social_provider_user->id,
                "social_provider_token" => $social_provider_user->token,
                "social_provider_refresh_token" => $social_provider_user->refreshToken,
            ]);
        }

        Auth::login($user);

        return $this->showCredentials(Auth::user());
    }
}
