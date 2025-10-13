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
        // --- START: เพิ่มโค้ด 1 บรรทัดนี้เข้าไป ---
        $middleware->redirectGuestsTo(fn () => route('logins.form'));
        // --- END: เพิ่มโค้ด 1 บรรทัดนี้เข้าไป ---
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();