<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use App\Services\ActivationService;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display form to register
     *
     * @return register view
     */
    public function register()
    {
        return view('public.auth.register');
    }

    /**
     * Handle user register and send email
     *
     *@param array $request [request register user]
     *
     * @return register view
     */
    public function handleRegister(RegisterRequest $request)
    {
        app(ActivationService::class)->register($request->all());
        return redirect()->route('public.login');
    }

    /**
     * Handle user register and send email
     *
     *@param string $token [identify user]
     *
     * @return register view
     */
    public function activation($token)
    {
        app(ActivationService::class)->activation($token);

        return redirect()->route('public.login');
    }
}
