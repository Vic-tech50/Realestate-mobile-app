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
use App\NativeComponents\Property;
use App\NativeComponents\service;
use App\NativeComponents\viewproperty;
use Illuminate\Support\Facades\Route;

// Route::native('/', Home::class);
Route::native('/service', service::class);
Route::native('/about', About::class);
Route::native('/', Property::class);
Route::native('/agent', Agent::class);
Route::native('/login', Login::class);
Route::native('/viewproperty/{id}', viewproperty::class);



Route::nativeGroup(AppLayout::class, function () {
    Route::native('/agentdashboard', agentdashboard::class);
    Route::native('/addproperty', addproperty::class);
    Route::native('/profile', agentprofile::class);
    Route::native('/editprofile', editprofile::class);
    Route::native('/editproperty/{id}', editproperty::class);
});
