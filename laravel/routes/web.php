<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [ColocationController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login_form');
Route::get('/register', [RegisterController::class, 'RegisterForm'])->name('register_form');
Route::post('/register/register', [RegisterController::class, 'Register'])->name('register');
Route::post('/login/login', [LoginController::class, 'Login'])->name(('login'));
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
