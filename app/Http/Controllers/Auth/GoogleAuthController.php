<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\UserService;
use App\Http\Services\ServiceInterface;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getAuthenticationPage()
    {
        return Socialite::driver('google')->redirect();
    }
    public function getCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $existUser = $this->userService->getFirst('email', $user->email);

            if (!$existUser) {
                $store = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => now()
                ]);
                auth()->login($store, true);
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            auth()->login($user, true);
            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }
}