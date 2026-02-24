<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }
    public function Login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $credentials = ["email" => $email, "password" => $password];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/');
        }else{
            // smth wrong
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.'
            ])->onlyInput('email');
        }
    }
}
