<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\UserApiService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function profile($username){
        $data = new UserApiService();
        $data = $data->id($username);
        return view('profile')->with('data', $data);
    }
    public function verify(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if (
            Auth::attempt([
                'name' => $request->name,
                'password' => $request->password
            ])
        ) {
            session(['role' => Auth::user()->role]);
            session(['username' => Auth::user()->name]);
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('login.index');
        }
    }
    public function store(Request $request)
    {
        if (
            $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ])
        ) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('login.index');
        } else {
            return redirect()->route('register.index');
        }
    }
    public function update(Request $request){
        if ($request->password) {
            if (
                $request->validate([
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed'
                ])
            ) {
                User::where('id', $request->id)->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            }
        } else {
            if (
                $request->validate([
                    'email' => 'required|email|unique:users',
                ])
            ) {
                User::where('id', $request->id)->update([
                    'email' => $request->email,
                ]);
            }
        }
        return redirect()->route('profile.index', $request->name);
    }
    public function logout(){
        Auth::logout();
        session(['role' => null]);
        session(['username' => null]);
        return redirect()->route('login.index');
    }
}
