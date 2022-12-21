<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

/**
 * Class RedirectIfAuthenticated.
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $logged_in_user = auth::user();
        if (auth()->guard($guard)->check()) {
            return redirect(after_login_url($logged_in_user));
        }

        return $next($request);
    }
}
