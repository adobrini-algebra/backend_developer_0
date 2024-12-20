<?php

use App\Http\Middleware\CheckUserIsWriter;
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
        // Middleware dodan u Web grupu middlewwarea, biti ce pozvan na svakom requestu
        // $middleware->web([
        //     'writer' => CheckUserIsWriter::class,
        //     'writer' => CheckUserIsWriter::class,
        // ]);

        // biti ce pozvan samo pozivanjem kljuca "writer"
        $middleware->alias([
            'writer' => CheckUserIsWriter::class,    
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();