<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController; 
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', function(){
    return view('login');
})->name('login')->middleware('guest');

Route::get('/redirect', [AuthController::class, 'redirect'])->name('redirect');
Route::get('/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('auth/google', [GoogleCalendarController::class, 'redirectToGoogle']); 
Route::get('auth/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
Route::get('/showEvents', [GoogleCalendarController::class, 'showEvents'])->name('showEvents');