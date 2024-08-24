<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function loginForm(): View|Factory|Application
    {
        return view('admin.login');
    }
    public function registrationForm(): View|Factory|Application
    {
        return view('admin.registration');
    }

    public function registration(UserRequest $request)
    {
        try {
            $registration = (new UserService())->storeItem($request->validated());
            if(!empty($registration)){
                return redirect()->route('admin.loginPage');
            }
            else
            {
                return redirect()->back()->with('error', 'Opps! Registration Failed..')->withInput($request->all());
            }

        }catch (\Throwable $throwable){
            return redirect()->back()->with('error', 'Something went wrong')->withInput($request->all());
        }
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
