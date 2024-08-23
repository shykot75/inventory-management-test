<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthenticateController::class, 'loginForm'])->name('loginPage')->middleware('redirectIfAuthenticated');
    Route::post('/login/store', [AuthenticateController::class, 'login'])->name('login');
    Route::post('/logout', [AuthenticateController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });
});
