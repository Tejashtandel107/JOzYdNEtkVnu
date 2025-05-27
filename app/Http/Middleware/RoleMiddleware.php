<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect ()->route('login');
        }
        else{
            $auth_role_id = Auth::user()->getRoleId();
            if (!in_array($auth_role_id,array(config('constant.ROLE_SUPER_ADMIN_ID')))) {
               abort(403);
            }    
        }
        return $next($request);
    }
}
