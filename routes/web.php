<?php

use App\Http\Controllers\AuthController;
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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::post("/login", [AuthController::class, "create"]);
Route::get("/verify", [AuthController::class, "verify"])->name('verify');

Route::post("/verify-code", [AuthController::class, "verify"])->name('verify-code');
Route::post("/resend-code", [AuthController::class, "resend"]);
