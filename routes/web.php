<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoPostController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'stripe'], function () {

    Route::get('checkout', [StripeController::class, 'checkout'])->middleware('loggor');

    Route::get('checkout_with_di', [StripeController::class, 'customCheckoutWithDI']);

    Route::get('checkout_without_di', [StripeController::class, 'customCheckoutWithDI']);
});

Route::group(['prefix' => 'posts'], function () {

    Route::get('', [DemoPostController::class, 'post']);
});

Route::get('logger', LoggerController::class);

Route::get('uuid', function () {
    /** @disregard */
    return Help::generateUUID();
});

Route::get('now_formatted', function () {
    /** @disregard */
    return Help::nowFormatted('d-m-Y');
});

Route::get('users/{user}', [UserController::class, 'show']);

/*
 hasOne() relationship must be retrieved without binding the child in route.

 Route::get('users/{user}/wallet/{wallet}', [UserController::class, 'show']); Will not work. Laravel is checking for a relationship called `wallets` instead of `wallet`.
*/
Route::get('users/{user}/wallet', [UserController::class, 'wallet']);

/*
    Customizing the Key.

    getRouteKeyName() method added in Wallet model to use unique_id as defalut key (when not implicitly defined).
*/
Route::get('wallets/{wallet}', [WalletController::class, 'show']); // {http://127.0.0.1:8000/wallets/677a49e86d80a} (default)

Route::get('wallets/{wallet:id}', [WalletController::class, 'show']); // {http://127.0.0.1:8000/wallets/id} (default)

/*
    Below routes will works same.
    If child implicitly defined. Laravel will retrieve the Post & will check if it belongs to the User.
    If child implicitly defined, but called scopeBindings(), Laravel will retrieve the Post & will check if it belongs to the User.

    If child not implicitly defined & scopeBindings is also not called. It will retrieve the post, will not check if it's belongs to user/not.

    Route::get('users/{user}/posts/{post}', [PostController::class, 'show']);
*/
Route::get('users/{user}/posts/{post:id}', [PostController::class, 'show']);

Route::get('users/{user}/posts/{post}', [PostController::class, 'show'])->scopeBindings();
