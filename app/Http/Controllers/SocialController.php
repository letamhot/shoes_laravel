<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Exception;
use Str;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ReplyMail;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->stateless()->user();
        $check = User::where('provider_id', $getInfo->id)->first();
        if (!$check) {
            $password = Str::random(6);
            $user = $this->createUser($getInfo, $provider, $password);
            $message = "Your password is: <b>" . $password . "</b>. <br/> You should change your password immediately to avoid forgetting your password !";
            Mail::to($getInfo->email)->send(new ReplyMail($getInfo, $message));
            auth()->login($user);
            return redirect()->to('/')->with("success", "Login to first time success, password send to your email");
        } else {
            $user = $this->createUser($getInfo, $provider, $password);
            auth()->login($user);
            return redirect()->to('/')->with("success", "Login to success");
        }
    }
    function createUser($getInfo, $provider, $password)
    {

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'image'    => $getInfo->avatar,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make($password),
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}