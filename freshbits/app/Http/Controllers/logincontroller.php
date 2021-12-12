<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class logincontroller extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ]);

        $validator['password'] = Hash::make($request->password);
        $user = User::create($validator);
        return redirect('login')->with('success', 'You are Register successfully.');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($credential)) {
            return redirect('product')->with('success', 'You are login successfully.');
        } else {
            return redirect('login')->with('error', 'Invalid login credential.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success', 'you are logout.');
    }

    public function forgotpass(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password|min:8',
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $check = User::where('email', $email)->first();
        if($check != null){
            $check->password = Hash::make($request->new_password);
            $check->save();

            return redirect('login')->with('success', 'Your password changed successfully.');
        }else{
            return redirect('login')->with('error', 'Your Email Id is wrong. Please try again.');
        }
    }
}
