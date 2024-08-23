<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Services\UserService;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(): View|Factory|Application
    {
        try {
            $users = $this->userService->getItemList();
            return view('admin.user.index', compact('users'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }
    public function create(): View|Factory|Application
    {
        try {
            return view('admin.user.createUpdate');
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());

        }
    }

    public function store(UserRequest $request): RedirectResponse
    {
        try {
            $this->userService->storeItem($request->validated());
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');
        }catch (\Throwable $throwable){
            return redirect()->back()->with('error', 'User invalid data')->withInput($request->all());
        }
    }



}
