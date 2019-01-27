<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Show login form
     *
     * @return void
     */
    public function login()
    {
        return view('public.auth.login');
    }

    /**
     * Handle data from login form
     *
     *@param collection $request [request login]
     *
     * @return void
     */
    public function handleLogin(LoginRequest $request)
    {
        return app(LoginService::class)->userLogin($request->except(['_token']));
    }
}
