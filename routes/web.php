<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;

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
    return view('home');
});
Route::get('/registration', [AuthenticateController::class, 'registrationForm'])->name('user.registrationForm');
Route::post('/registration/store', [AuthenticateController::class, 'registration'])->name('user.registration.store');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthenticateController::class, 'loginForm'])->name('loginPage')->middleware('redirectIfAuthenticated');
    Route::post('/login/store', [AuthenticateController::class, 'login'])->name('login');
    Route::post('/logout', [AuthenticateController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth']], function() {
        // Admin / User Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Management (Admin Only)
        Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['auth', 'checkRole:admin']], function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        });

        // Product Management (Admin Only)
        Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['auth', 'checkRole:admin']], function() {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{productId}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{productId}', [ProductController::class, 'update'])->name('update');
            Route::delete('/delete/{productId}', [ProductController::class, 'destroy'])->name('delete');
        });

        // Purchase Management
        Route::group(['prefix' => 'purchase', 'as' => 'purchase.', 'middleware' => ['auth', 'checkRole:admin']], function() {
            Route::get('/', [PurchaseController::class, 'index'])->name('index');
            Route::get('/create', [PurchaseController::class, 'create'])->name('create');
            Route::post('/store', [PurchaseController::class, 'store'])->name('store');
            Route::get('/pdf/{purchaseId}', [PurchaseController::class, 'purchasePDF'])->name('pdf');

            // Purchase Return
            Route::get('/return', [PurchaseController::class, 'purchaseReturnList'])->name('return.list');
            Route::get('/return/{purchaseId}', [PurchaseController::class, 'purchaseReturnCreate'])->name('return.create');
            Route::post('/return/store', [PurchaseController::class, 'purchaseReturnStore'])->name('return.store');
            Route::get('/return/pdf/{purchaseId}', [PurchaseController::class, 'purchaseReturnPDF'])->name('return.pdf');
        });

        // Sales Management
        Route::group(['prefix' => 'sale', 'as' => 'sale.', 'middleware' => ['auth', 'checkRole:admin']], function() {
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/create', [SalesController::class, 'create'])->name('create');
            Route::post('/store', [SalesController::class, 'store'])->name('store');
            Route::get('/pdf/{saleId}', [SalesController::class, 'salePDF'])->name('pdf');

            // Sales Return
            Route::get('/return', [SalesController::class, 'saleReturnList'])->name('return.list');
            Route::get('/return/{saleId}', [SalesController::class, 'saleReturnCreate'])->name('return.create');
            Route::post('/return/store', [SalesController::class, 'saleReturnStore'])->name('return.store');
            Route::get('/return/pdf/{saleId}', [SalesController::class, 'saleReturnPDF'])->name('return.pdf');
        });

        // Reports
        Route::group(['prefix' => 'report', 'as' => 'report.', 'middleware' => ['auth' ]], function() {
            Route::get('/purchase', [ReportController::class, 'purchaseReport'])->name('purchase');
            Route::get('/purchase/pdf/{purchaseId}', [ReportController::class, 'purchaseReportPDF'])->name('purchase.pdf');

            // Purchase Return
            Route::get('/purchase/return', [ReportController::class, 'purchaseReportReturnList'])->name('purchase.return');
            Route::get('/purchase/return/pdf/{purchaseId}', [ReportController::class, 'purchaseReportReturnPDF'])->name('purchase.return.pdf');

            Route::get('/sales', [ReportController::class, 'salesReport'])->name('sale');
            Route::get('/sales/pdf/{saleId}', [ReportController::class, 'salesReportPDF'])->name('sale.pdf');

            // sales return
            Route::get('/sales/return', [ReportController::class, 'salesReportReturnList'])->name('sale.return');
            Route::get('/sales/return/pdf/{saleId}', [ReportController::class, 'salesReportReturnPDF'])->name('sale.return.pdf');
        });

    });
});
