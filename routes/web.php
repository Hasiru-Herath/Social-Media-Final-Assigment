<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GogleAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('books', BookController::class);



Route::get('auth/google', [GogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GogleAuthController::class, 'callbackGoogle']);
