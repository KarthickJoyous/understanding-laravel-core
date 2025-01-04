<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'stripe'], function () {

    Route::get('checkout', [StripeController::class, 'checkout']);

    Route::get('checkout_with_di', [StripeController::class, 'customCheckoutWithDI']);

    Route::get('checkout_without_di', [StripeController::class, 'customCheckoutWithDI']);
});
