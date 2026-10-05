<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            // 'address' => 'nullable',

        ]);

        $user = User::find(Auth::user()->id);

        $user->name =  $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // $user->address = $request->address;

        $user->save();

        return back()->with('message', 'User Information Updated');
    }

    public function update_password(Request $request)
    {

        $member = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed|different:current_password',

        ]);

        if (Hash::check($request->current_password, $member->password)) {
            $user = User::find($member->id);
            $user->password = bcrypt($request->password);
            $user->save();

            return back()->with('message', 'Your Password Has Been Updated');
        } else {
            return back()->with('error', 'Incorrect Crediential');
        }
    }
}
