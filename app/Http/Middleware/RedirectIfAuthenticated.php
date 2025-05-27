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
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
         $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
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
        }

        return $next($request);
    }
}
