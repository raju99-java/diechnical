<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FranchiseNotAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'franchise') {
        if (!Auth::guard($guard)->guest()) {
            return redirect()->route('franchise-dashboard');
        }
        return $next($request);
    }

}
