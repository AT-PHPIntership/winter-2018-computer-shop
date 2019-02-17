<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request [request login]
     * @param \Closure                 $next    [pass login form]
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_actived != '1') {
            Auth::logout();
            session()->flash('warning', __('public.login.yet'));
            return redirect()->route('public.login');
        } else {
            return $next($request);
        }
    }
}
