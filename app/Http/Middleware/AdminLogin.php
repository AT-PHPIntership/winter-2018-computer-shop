<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request from form login
     * @param \Closure                 $next    Closure
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->name == Role::ROLE_ADMIN) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('warning', __('common.warning_login'));
            // return redirect()->route('admin.login')->with('warning', __('common.warning_login'));
        }
    }
}
