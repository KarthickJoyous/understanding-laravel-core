<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;

Route::controller(RegisterController::class)
    ->middleware('guest.admin')
    ->name('auth.register.')
    ->group(function () {

        Route::get('register', 'form')->name('form');

        Route::post('register', 'register')->name('register');
    });

Route::controller(LoginController::class)
    ->middleware('guest.admin')
    ->name('auth.login.')
    ->group(function () {

        Route::get('login', 'form')->name('form');

        Route::post('login', 'login')->name('login');
    });

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('', [HomeController::class, 'welcome'])->name('welcome');

    Route::post('logout', [HomeController::class, 'logout'])->name('logout');
});
