<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\DIPostController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DBPostQueryBuilderController;
use App\Http\Controllers\DBUserQueryBuilderController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\PaginateController;
use App\Http\Controllers\SecurityController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'stripe'], function () {

    Route::get('checkout', [StripeController::class, 'checkout'])->middleware('loggor');

    Route::get('checkout_with_di', [StripeController::class, 'customCheckoutWithDI']);

    Route::get('checkout_without_di', [StripeController::class, 'customCheckoutWithDI']);
});

Route::group(['prefix' => 'posts'], function () {

    Route::get('', [DIPostController::class, 'post']);
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
    ONE-TO-ONE (User (parent) - Wallet (child)) :

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
    hasMany (User hasMany Posts)
    hasMany (Post hasMany Comments)
*/
Route::get('users/{user}/posts', [UserPostController::class, 'index']);

/*
    Below routes will works same.
    If child implicitly defined. Laravel will retrieve the Post & will check if it belongs to the User.
    If child implicitly defined, but called scopeBindings(), Laravel will retrieve the Post & will check if it belongs to the User.

    If child not implicitly defined & scopeBindings is also not called. It will retrieve the post, will not check if it's belongs to user/not.

    Route::get('users/{user}/posts/{post}', [UserPostController::class, 'show']);
*/
Route::get('users/{user}/posts/{post:id}', [UserPostController::class, 'show']);

Route::get('users/{user}/posts/{post}', [UserPostController::class, 'show'])->scopeBindings();

/*  
    hasOne Inverse (BelongsTo) (Post belongsTo User)
    hasMany (Post hasMany Comments)
    hasOne Inverse (BelongsTo) (Comment belongs to User)
*/
Route::resource('posts', PostController::class)->only(['index', 'show']);

/*  
    hasOne Inverse (BelongsTo) (Comment belongsTo Post)
    hasOne Inverse (BelongsTo) (Comment belongsTo User)
*/

Route::get('comments/{comment}/media', [CommentController::class, 'media']);

Route::resource('comments', CommentController::class)->only(['index', 'show']);


/*
    hasOneThrough (This can be achieved by using a nested relationship as well, but that will retrieve extra data)

    Broker (belongsTo Property)
    Property (hasOne Broker & belongsTo Project)
    Project (hasOne Property)

    Project-Broker (No direct relationship) : Using hasOneThrough to Retrieve Project for Broker & Broker for Project.
*/

Route::resource('projects', ProjectController::class)->only(['index', 'show']);

Route::resource('mechanics', MechanicController::class)->only(['index', 'show']);

/*
    Many to Many

    User hasMany Roles.
    Role hasMany Users.
*/

Route::get('users/{user}/roles', [UserController::class, 'roles']);

Route::get('roles', [RoleController::class, 'index']);

Route::get('roles/{role}', [RoleController::class, 'show']);

Route::resource('media', MediaController::class)->only(['index', 'show']);

Route::controller(PaginateController::class)->group(function () {

    Route::get('paginate', 'paginate');

    Route::get('simplePaginate', 'simplePaginate');

    Route::get('cursorPaginate', 'cursorPaginate');
});

Route::controller(JoinController::class)->prefix('join')->group(function () {

    Route::get('', 'join');

    Route::get('left', 'left');

    Route::get('right', 'right');

    Route::get('self', 'self');

    Route::get('cross', 'cross');

    Route::get('full', 'full');
});

Route::group(['prefix' => 'query_builders'], function () {

    Route::resource('users', DBUserQueryBuilderController::class)->names('query_builders.users')->only(['index', 'store', 'show', 'destroy']);

    Route::resource('posts', DBPostQueryBuilderController::class)->names('query_builders.posts')->only(['index', 'store', 'show', 'destroy']);
});

Route::resource('garages', GarageController::class)->only(['index', 'show']);

Route::resource('securities', SecurityController::class)->only(['index', 'show']);