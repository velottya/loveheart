<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\FormDiagnosisController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Models\FormDiagnosis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => ''], function () {
    Route::get('/', function () {
        return view('home.home');
    })->name('home');
    Route::get('/about', function () {
        return view('home.about');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('/regist', [UserRegisterController::class, 'showRegistration'])->name('register');
    Route::post('/regist', [UserRegisterController::class, 'register'])->name('register.process');
    Route::get('/email/verify/{token}', [UserRegisterController::class, 'verifyEmail'])->name('email.verify');
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});
Route::middleware(['auth', 'akses:user'])->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::post('/contact', [UserDataController::class, 'contact'])->name('contact');
        Route::get('/form', [FormDiagnosisController::class, 'create'])->name('form');
        Route::get('/result', [FormDiagnosisController::class, 'result'])->name('result');
        Route::post('/history', [FormDiagnosisController::class, 'store'])->name('history.store');
        Route::get('/history', [FormDiagnosisController::class, 'history'])->name('history');
        Route::delete('/history/{id}', [FormDiagnosisController::class, 'destroy'])->name('destroy');
        Route::get('/my-profile', [UserDataController::class, 'showUserData'])->name('profile.show');
        Route::get('/my-profile/edit', [UserDataController::class, 'editUserData'])->name('profile.edit')->middleware(['auth', 'akses:user']);
        Route::patch('/my-profile/edit', [UserDataController::class, 'update'])->name('profile.update')->middleware(['auth', 'akses:user']);
        Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change.password.form');
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
    });
    Route::get('/service', function () {
        return view('home.service');
    });
    Route::get('/termofservice', function () {
        return view('home.tos');
    });
});

Route::get('/logout', [SesiController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'akses:admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/user-result', [AdminController::class, 'showUserDiagnostic'])->name('admin.userresult');
        Route::delete('/user-result/{editusertesdata}', [AdminController::class, 'historyDestroy'])->name('admin.userresult.destroy')->middleware(['auth', 'akses:admin']);
        Route::get("/user-profile", [AdminController::class, "showUser"])->name('admin.userprofile')->middleware(['auth', 'akses:admin']);
        Route::get("/user-profile/add-user", [AdminController::class, "showAddUser"])->name('admin.adduser')->middleware(['auth', 'akses:admin']);
        Route::post("/user-profile/add-user", [AdminController::class, "addUser"])->name('admin.adduser')->middleware(['auth', 'akses:admin']);
        Route::delete('/user-profile/{userdestroy}', [AdminController::class, 'userDestroy'])->name('admin.userprofile.destroy')->middleware(['auth', 'akses:admin']);
        Route::get("/dataset", [DatasetController::class, "showDataset"])->name('admin.dataset')->middleware(['auth', 'akses:admin']);
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('admin.profile')->middleware(['auth', 'akses:admin']);
    });
});

Route::get('password/forgot', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword'])->name('password.forgot.submit');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset.submit');
