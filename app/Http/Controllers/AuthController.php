<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function do_login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:dns,rfc'],
            'password' => ['required']
        ]);

        $rtn = ['code' => 1, 'message' => 'Invalid email/password'];
        if(Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])){
            $request->session()->regenerate();
            $rtn = ['code' => 0];
        }

        return response()->json($rtn);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function do_register(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:dns,rfc'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json([
            'code' => 0
        ]);
    }
}
