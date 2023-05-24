<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('home.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::user()->id;

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with(['error', 'Old Password is Invalid']);
        } else {
            $data['password'] = Hash::make($request->new_password);
            User::where('id', $user)->update($data);
            return redirect()->route('logout');
        }
    }
}
