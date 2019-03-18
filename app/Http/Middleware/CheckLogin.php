<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Role;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request [request to login]
     * @param \Closure                 $next    [show view login]
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->name == Role::ROLE_ADMIN) {
            return redirect()->route('admin.home');
        } elseif (Auth::check() && Auth::user()->role->name == (Role::ROLE_NORMAL || Role::ROLE_VIP)) {
            return redirect()->route('user.profile');
        }
        return $next($request);
    }
}
