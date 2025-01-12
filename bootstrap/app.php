<?php

use App\Http\Middleware\AdminRedirectIfAuthenticated;
use App\Http\Middleware\AppLogger;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\LevelOneMiddleware;
use App\Http\Middleware\LevelTwoMiddleware;
use App\Http\Middleware\LevelThreeMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(append: [
        //     LevelOneMiddleware::class,
        //     LevelTwoMiddleware::class,
        //     LevelThreeMiddleware::class
        // ]);
        $middleware->alias([
            'loggor' => AppLogger::class,
            'guest.admin' => AdminRedirectIfAuthenticated::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
