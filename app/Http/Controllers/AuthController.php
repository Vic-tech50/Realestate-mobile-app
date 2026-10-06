<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.home');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('message', 'Your account is blocked. Please contact the administrator.');
            }
        } else {
            // Invalid credentials, show error
            return redirect()->route('login')
                ->with('message', 'Email-Address and Password are incorrect.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
