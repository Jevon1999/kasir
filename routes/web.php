<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login',fn () => view('auth.login'))->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/registerr', fn() => view('auth.register'))->name('register');
Route::post('/register',[AuthController::class,'register']);

Route::group(['middleware' => ['auth', 'check_role:customer']], function(){
    Route::get('/verify',[VerificationController::class,'index']);
});

Route::group(['middleware' => ['auth', 'check_role:admin,staff']], function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
});

Route::group(['middleware' => ['auth', 'check_role:customer', 'check_status']], function(){
    Route::get('/customer', fn () => 'halaman customer');
});

Route::group(['middleware' => ['auth', 'check_role:admin']], function(){
    Route::get('/staff  ', fn () => 'halaman staff');
});


Route::get('/logout', [AuthController::class,'logout']);