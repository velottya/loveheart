<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserDataController extends Controller
{
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        Mail::to('loveyourheart2023@gmail.com')->send(new ContactMail($data));

        return redirect()->route('home');
    }
    public function showUserData()
    {
        $user = Auth::user();
        return view('home.profile', compact('user'));
    }
    public function editUserData()
    {
        $user = Auth::user();
        return view('home.editprofile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'username' => 'required|string|max:10|unique:users',
            'fullname' => 'required|string|max:100',
            'image' => 'file|image|max:2048|dimensions:ratio=1/1',
        ]);

        $data = $request->only(['fullname', 'username']);

        $previousPhoto = Auth::user()->image;

        if ($request->image) {
            if ($previousPhoto && File::exists(public_path('profile/' . $previousPhoto) !== 'profile/photo/default.png')) {
                File::delete(public_path('profile/' . $previousPhoto));
            }
            $extFile = $request->image->getClientOriginalExtension();
            $nameFile = 'profile-' . time() . "." . $extFile;
            $request->image->move('profile', $nameFile);
            $data['image'] = $nameFile;
        }

        User::where('id', $user)->update($data);

        return redirect()->route('profile.show');
    }
}
