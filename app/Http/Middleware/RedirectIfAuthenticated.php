<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Closure                 $next    Closure
     * @param string|null              $guard   guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role->name == Role::ROLE_ADMIN) {
                return redirect('/admin/home');
            } else {
                return redirect('/home');
            }
        }


        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        return $next($request);
    }
}
