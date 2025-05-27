<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
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
        if (Auth::guest ()) {
            return redirect ()->route('login');
        }
        else{
            $auth_role_id = Auth::user()->getRoleId();
            if (in_array($auth_role_id,array(config('constant.ROLE_SUPER_ADMIN_ID'),config('constant.ROLE_ADMIN_ID')))) {
               return redirect()->route ('admin.home');
            }
        }
        return $next($request);
    }
}
