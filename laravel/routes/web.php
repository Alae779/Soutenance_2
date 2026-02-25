<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
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


Route::get('/create', [ColocationController::class, 'create'])->name('create_colocation');
Route::get('/show/{id}', [ColocationController::class, 'show'])->name('show_colocation');
Route::post('/store', [ColocationController::class, 'store'])->name('store_colocation');
//show invitation form
Route::get('/invite/{colocation}', [InvitationController::class, 'invite'])->name('invite');
Route::get('/cancel', [ColocationController::class, 'cancel'])->name('cancel');
Route::get('/leave', [ColocationController::class, 'leave'])->name('leave');

Route::get('/create/category/{colocation}', [CategoryController::class, 'create'])->name('create_category');
Route::post('/store/category/{colocation}', [CategoryController::class, 'store'])->name('store_category');

Route::get('/invite/{colocation}', [InvitationController::class, 'invite'])->name('invite');
Route::post('/send/invitation/{colocation}', [InvitationController::class, 'send'])->name('send_invitation');
Route::get('/accept/invitation/{colocation}', [InvitationController::class, 'accept'])->name('accept_invitation');

