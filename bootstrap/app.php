<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web','auth:admin'])->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Illuminate\Auth\Middleware\Authenticate::class,
            'PreventBackHistory' => App\Http\Middleware\PreventBackHistory::class,
            'checkRole' => App\Http\Middleware\CheckRole::class,
            'guest' => App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);
        $middleware->redirectGuestsTo(fn (Request $request) => 
            $request->is('dw-admin*') ? route('login') : route('login')
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
    })
    ->withProviders([
        Yajra\DataTables\DataTablesServiceProvider::class,
        Eusonlito\LaravelMeta\MetaServiceProvider::class
        //App\Providers\ViewServiceProvider::class,
        //App\Providers\AuthServiceProvider::class
    ])
    ->create();
