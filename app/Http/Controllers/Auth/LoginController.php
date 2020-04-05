<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Users;
use App\User;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function doLogin(Request $request)
    {
        try {



            $message = trans('messages.invalid_login_credentials');
            $rememberMe = false;
            $users = Users::where('email', $request->email)->first();


            if (!empty($users)) {

                $isPasswordMatched = \Hash::check($request->password, $users->password);
                if ($isPasswordMatched) {
                    // đoạn này là đăng nhập thành công rồi, gán session voi key 'remember_token' va nhan gt cua $users->remember_token.
                    $request->session()->put('remember_token', $users->remember_token);

                    $request->session()->put('username', $users->name);
                    Auth::loginUsingId($users->id, $rememberMe);
                    return redirect('shoesHome');
                }
            }
        } catch (\Exception $e) {
            Log::error(__CLASS__ . "::" . __METHOD__ . "  " . $e->getMessage() . "on line" . $e->getLine());
        }
        return view('/shoes.login')->with('error_msg', $message);
    }


    public function logoutshoes(Request $request)
    {
        Auth::logout();

        return view('/shoes.login');
    }



    public function showLogin(Request $request)
    {
        if ($request->session()->has('remember_token'))
            return redirect('shoesHome');


        return view('shoes.login');
    }
}