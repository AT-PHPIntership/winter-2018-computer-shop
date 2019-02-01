<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Services\SocialProviderService;
use Socialite;

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
    // protected $redirectTo = '/home';
    protected $redirectTo = '/admin/home/';


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request Request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login');
        // return $this->loggedOut($request) ?: redirect('/admin/login');
    }

    /**
     * Login
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

      /**
     * Redirect the user to the provider authentication page.
     *
     *@param collection $provider [request login]
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     *@param collection $provider [request login]
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            app(SocialProviderService::class)->createOrGetUser($provider);
            return redirect()->route('user.profile');
        } catch (\Exception $ex) {
            session()->flash('warning', $ex->getMessage());
            return redirect()->route('public.login');
        }
    }

     /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
}
