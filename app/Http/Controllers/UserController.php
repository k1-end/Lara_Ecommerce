<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login_page(Request $request)
    {
        return view('login');
    }

    public function auth_user(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function signup_page(Request $request)
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email' , 'unique:users'],
            'password' => ['required' , Password::min(8)],
            'name' =>['required' , 'min:8' , 'unique:users']
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('home');
    }

    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }
        return view('dashboard.users')->with('users' , User::all());
    }

    public function show(User $user)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }
        return view('dashboard.user')->with('user' , $user);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
