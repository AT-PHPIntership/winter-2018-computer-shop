<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        if (Auth::check() && !in_array(Auth::user()->role->id, $permissions)) {
            return redirect()->route('admin.home'); // redirect to dashboard
        }
        return $next($request);
    }
}
