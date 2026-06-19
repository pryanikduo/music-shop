<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Регистрируем алиасы для middleware
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'setlocale' => \App\Http\Middleware\SetLocale::class, // <-- ДОБАВИТЬ ЭТУ СТРОКУ
        ]);

        // Если вы хотите, чтобы SetLocale применялся ко всем маршрутам (включая административные), 
        // можно добавить в группу web, но в вашем случае это не нужно, так как вы явно указываете его в маршрутах.
        // $middleware->web(append: [
        //     \App\Http\Middleware\SetLocale::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();