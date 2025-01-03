<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->group('auth.admin', [
            App\Http\Middleware\CheckAuthenticatedAdmin::class
        ]);
        $middleware->group('auth.role.admin', [
            App\Http\Middleware\CheckAuthenticatedAdminRole::class
        ]);
        $middleware->group('auth', [
            App\Http\Middleware\CheckAuthenticatedUser::class,
        ]);
        $middleware->group('guest', [
            App\Http\Middleware\RedirectIfAuthenticated::class
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
