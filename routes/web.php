<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ahad', function () {
    return view('ahad ');
});

Route::get('account/register',[AccountController::class,'register'])->name('account.register');
Route::post('account/register',[AccountController::class,'processRegister'])->name('account.processRegister');
Route::get('account/login',[AccountController::class,'login'])->name('account.login');
Route::post('account/login',[AccountController::class,'authenticate'])->name('account.authenticate');
Route::get('account/profile',[AccountController::class,'profile'])->name('account.profile');
