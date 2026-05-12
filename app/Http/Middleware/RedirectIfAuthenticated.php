<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            /* if(Route::is('admin.*')) {
                return route('admin.login');
            } */

            return route('login');
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /* if($guard === 'admin'){
                    return redirect()->route('filament.admin.auth.login');
                } */
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
