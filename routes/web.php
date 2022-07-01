<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post("/reset-password", [AuthController::class, "create"]);

Route::get('/reset-password', function () {
    return view('auth/reset-password');
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', DashboardController::class)->only(["index"]);;
    Route::resource('portfolio', PortfolioController::class)->only(["index", 'store', "create"]);
    Route::resource('cashier/deposite',  DepositeController::class)->only(["show", "store"]);
    Route::resource('cashier/withdraw',  WithdrawController::class)->only(["show", "store"]);
    Route::resource('message',  WithdrawController::class)->only(["index", "show", "store"]);
    Route::get('transactions', [PortfolioController::class, "transactions"]);
});
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->name('logout');
Route::get("/verify", [AuthController::class, "verify"])->name('verify');

Route::post("/verify-code", [AuthController::class, "verify"])->name('verify-code');
Route::post("/resend-code", [AuthController::class, "resend"]);
