<?php

use App\Http\Middleware\AppLogger;
use App\Http\Middleware\LevelOneMiddleware;
use App\Http\Middleware\LevelThreeMiddleware;
use App\Http\Middleware\LevelTwoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(append: [
        //     LevelOneMiddleware::class,
        //     LevelTwoMiddleware::class,
        //     LevelThreeMiddleware::class
        // ]);
        $middleware->alias([
            'loggor' => AppLogger::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
