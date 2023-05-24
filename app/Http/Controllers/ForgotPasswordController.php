<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = Str::random(60);
        $user->reset_password_token = $token;
        $user->reset_password_expires = now()->addMinutes(60);
        $user->save();

        $resetLink = route('password.reset', ['token' => $token]);
        // Kirim email reset password
        // Sesuaikan dengan konfigurasi email Anda
        Mail::send('auth.reset-password-email', ['resetLink' => $resetLink], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Your Password');
        });

        return redirect()->back()->with('success', 'Password reset link sent to your email');
    }
}
