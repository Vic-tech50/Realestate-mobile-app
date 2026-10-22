<?php

use App\NativeComponents\About;
use App\NativeComponents\addproperty;
use App\NativeComponents\Agent;
use App\NativeComponents\agentdashboard;
use App\NativeComponents\agentprofile;
use App\NativeComponents\editprofile;
use App\NativeComponents\editproperty;
use App\NativeComponents\Home;
use App\NativeComponents\Layouts\AppLayout;
use App\NativeComponents\Login;
use App\NativeComponents\aichat;
use App\NativeComponents\Property;
use App\NativeComponents\service;
use App\NativeComponents\uploaddocument;
use App\NativeComponents\verificationstatus;
use App\NativeComponents\verifyagent;
use App\NativeComponents\viewproperty;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\NativeComponents\welcomepage;
// use App\NativeComponents\forgetpassword;

Route::get('/admin/login', function () {
    return view('web.login');
})->name('login');
Route::get('/forgetpassword', function () {
    return view('web.forgetpassword');
})->name('forgetpassword');

Route::get('/md', function () {
    return bcrypt('welcome');
});

Route::post('/authLogin', [AuthController::class, 'login']);
Route::post('/forgetpassword', [AuthController::class, 'forgetPassword']);
Route::get('/reset-password/{token}', [AuthController::class,'showResetPasswordForm'])->name('password.reset');

Route::post('/reset-password', [AuthController::class,'resetPassword'])->name('password.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::resources([
        'agents' => AgentController::class,
        'properties' => PropertiesController::class,
        'notification' => NotificationController::class,
    ]);

     Route::post('/agents/{agent}/block', [AgentController::class, 'block'])
            ->name('agents.block');

        Route::post('/agents/{agent}/unblock', [AgentController::class, 'unblock'])
            ->name('agents.unblock');
    Route::post('update_profile', [ProfileController::class, 'update_profile'])->name('update.profile');
    Route::post('update_password', [ProfileController::class, 'update_password'])->name('update.password');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    // Route::post('/reinvest', [PlanController::class, 'reinvest'])->name('plan.reinvest');

});

// Route::native('/', Home::class);
Route::native('/service', service::class);
Route::native('/about', About::class);
Route::native('/', Property::class);
Route::native('/agent', Agent::class);
Route::native('/login', Login::class);
Route::native('/aichat', aichat::class);
Route::native('/welcome', welcomepage::class);
// Route::native('/forgetpassword', forgetpassword::class);
Route::native('/viewproperty/{id}', viewproperty::class);

Route::nativeGroup(AppLayout::class, function () {
    Route::native('/agentdashboard', agentdashboard::class);
    Route::native('/verificationstatus', verificationstatus::class);
    Route::native('/addproperty', addproperty::class);
    Route::native('/profile', agentprofile::class);
    Route::native('/editprofile', editprofile::class);
    Route::native('/verifyagent', verifyagent::class);
    Route::native('/upload', uploaddocument::class);
    Route::native('/editproperty/{id}', editproperty::class);
});
