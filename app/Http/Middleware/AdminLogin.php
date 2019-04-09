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
        if (Auth::check() && (Auth::user()->role->name == Role::ROLE_ADMIN || Auth::user()->role->name == Role::ROLE_SUB_ADMIN)) {
            return $next($request);
        }
        return redirect()->route('public.login')->with('warning', __('common.warning_login'));
    }
}
