<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;


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




    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Send Laravel's password reset email with a secure reset link.
        Password::sendResetLink(
            $request->only('email')
        );

        // Use the same message whether the email exists or not.
        return redirect()
            ->route('forgetpassword')
            ->with(
                'message',
                'If your email is registered, you will receive a password reset link shortly.'
            );
    }


    public function showResetPasswordForm($token)
    {
        return view('web.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('message', 'Your password has been reset successfully.');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
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
