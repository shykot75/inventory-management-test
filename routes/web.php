<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

        // User Management
        Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        });

        // Product Management
        Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{productId}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{productId}', [ProductController::class, 'update'])->name('update');
            Route::delete('/delete/{productId}', [ProductController::class, 'destroy'])->name('delete');
        });

    });
});
