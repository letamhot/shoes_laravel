<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.changePassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Success, Password has changed');
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('auth.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->name = request('name');
        $user->address = request('address');
        $user->save();

        return redirect()->back()->with('success', 'Success, Details has changed');
    }

    public function getEmailVerify()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('auth.email', compact('user'));
    }

    public function postEmailVerify(Request $request, User $user)
    {
        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'email' => ['required', 'email', 'unique:users']
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($user->password, $request->input('current_password'))) {
            return redirect()->route('email', $user->id)->with('success', 'Error');
        } else {
            $user->email = request('email');
            $user->save();
            return redirect()->route('details')->with('success', 'Success, Your email has changed');
        }
    }

    public function getUpdatePhone()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('auth.Phone', compact('user'));
    }

    public function postUpdatePhone(Request $request, User $user)
    {
        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', 'unique:users']
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($user->password, $request->input('current_password'))) {
            return redirect()->route('email', $user->id)->with('success', 'Error');
        } else {
            $user->phone = request('phone');
            $user->save();
            return redirect()->route('details')->with('success', 'Success, Your phone has changed');
        }
    }

    public function postChangeAddress(Request $request)
    {
        $this->validate($request, [
            'address' => 'required | string | min:5 | max:255'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->address = request('address');
        $user->save();
        return redirect()->back()->with('toast', 'Change address success');
    }
}