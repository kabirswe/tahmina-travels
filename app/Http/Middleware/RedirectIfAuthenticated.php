<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }
        if (Auth::guard($guard)->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('dashboard');
            } else if (auth()->user()->hasRole('vendor')) {
                return redirect()->route('seller.list');
            } else if (auth()->user()->hasRole('staff')) {
                return redirect()->route('sellerProductList');
            } else if (auth()->user()->hasRole('user')) {
                return redirect()->route('user.list');
            }
        }

        return $next($request);
    }
}
