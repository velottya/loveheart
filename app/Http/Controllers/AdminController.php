<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\Dataset;
use App\Models\FormDiagnosis;
use App\Models\ResultLatest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Show Total Data to Admin Dashboard
    public function showDashboard()
    {
        $userLastLogin = User::where('role', 'user')->whereNotNull('last_login')->paginate(10);
        $userLastLogin->onEachSide(1);
        $lastLoggedInUser = User::orderBy('last_login', 'desc')
            ->whereNotNull('last_login')
            ->first();
        if ($lastLoggedInUser) {
            $lastLoggedInTime = Carbon::parse($lastLoggedInUser->last_login);
            $formattedLastLoggedInTime = $lastLoggedInTime->diffForHumans();
        } else {
            $formattedLastLoggedInTime = 'Never';
        }
        $totalUser = User::where('role', 'user')->count();
        $totalDataset = Dataset::count();
        $totalDiagnostic = ResultLatest::count();
        return view('admin', ['totalUser' => $totalUser, 'totalDataset' => $totalDataset, 'totalDiagnostic' => $totalDiagnostic, 'userLastLogin' => $userLastLogin, 'formattedLastLoggedInTime' => $formattedLastLoggedInTime]);
    }
    // Show Dataset on Page Table
    public function showUser()
    {
        $showUser = User::where('role', 'user')->paginate(15);
        $showUser->onEachSide(1);
        return view('userprofile', ['showUser' => $showUser]);
    }
    public function showAddUser()
    {
        return view('adduser');
    }
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:10|unique:users',
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'role' => 'user',
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(60),
            'email_verified' => true,
        ]);
        Mail::to($request->email)->send(new VerifyEmail($user));
        return redirect()->route('admin.userprofile');
    }
    public function userDestroy(User $userdestroy)
    {
        $userdestroy->delete();
        return redirect()->route('admin.userprofile');
    }
    public function showProfile()
    {
        $admin = Auth::user();
        return view('profile', compact('admin'));
    }
    // Show User Diagnostic Result on Page User Tes Data
    public function showUserDiagnostic()
    {
        $showUserDiagnostic = FormDiagnosis::paginate(15);
        $showUserDiagnostic->onEachSide(1);
        return view('usertesdata', ['showUserDiagnostic' => $showUserDiagnostic]);
    }
    // Delete the User Diagnostic Result
    public function historyDestroy(FormDiagnosis $editusertesdata)
    {
        $editusertesdata->delete();
        return redirect()->route('admin.userresult');
    }
}
