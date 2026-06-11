<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')
                    ->stateless()
                    ->user();

    $user = User::updateOrCreate(
        [
            'email' => $googleUser->email,
        ],
        [
            'name'      => $googleUser->name,
            'google_id' => $googleUser->id,
            'role'      => 'customer',
            'password'  => bcrypt(uniqid()),
        ]
    );

    Auth::login($user);

    return redirect('/rental-mobil');
}
}