<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRegisterController extends Controller
{
    public function showRegistration()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:10|unique:users',
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'role' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(60),
        ]);

        Mail::to($request->email)->send(new VerifyEmail($user));

        return redirect()->route('login')->with('alert', 'Your account has been created successfully');
    }
    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->email_verified = true;
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('login')->with('success', 'Your account has been created successfully');
        } else {
            return redirect()->route('login')->with('error', 'Invalid verification token');
        }
    }
}
