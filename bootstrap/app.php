<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\penjualMiddleware;
use App\Http\Middleware\pembeliMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
            $middleware->alias([
            'adminMiddleware'   => adminMiddleware::class,
            'penjualMiddleware' => penjualMiddleware::class,
            'pembeliMiddleware' => pembeliMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
