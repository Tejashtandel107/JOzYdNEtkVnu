<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guard($guard)->check()) {
            $role_id = Auth::user()->getRoleId();
            if ($role_id==config ('constant.ROLE_SUPER_ADMIN_ID')) {
                return redirect ()->route('admin.home');
            }
            else if ($role_id==config ('constant.ROLE_ADMIN_ID')) {
                return redirect ()->route('admin.home');
            }
            else {
                return redirect ()->route('user.outwards.index');
            }
        }

        return $next($request);
    }
}
