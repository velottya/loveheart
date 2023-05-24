<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        $user = User::where('reset_password_token', $token)
            ->where('reset_password_expires', '>', now())
            ->first();

        if (!$user) {
            abort(404);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('reset_password_token', $request->token)
            ->where('email', $request->email)
            ->where('reset_password_expires', '>', now())
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid token or email');
        }

        $user->password = Hash::make($request->password);
        $user->reset_password_token = null;
        $user->reset_password_expires = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password has been reset');
    }
}
