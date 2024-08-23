<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticateController extends Controller
{
    public function loginForm(): View|Factory|Application
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try{
            $credentials = $request->only('email' , 'password');
            if(Auth::guard('web')->attempt($credentials)){
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->back()->with("error", "Email or Password doesn't match");
            }
        }catch(\Throwable $exception){
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.loginPage');
    }

}
