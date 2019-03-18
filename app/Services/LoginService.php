<?php

namespace App\Services;

use Auth;
use Session;
use Redirect;
use App\Models\Role;

class LoginService
{
    /**
    * Get child accessoris
    *
    * @param \Illuminate\Http\Request $data [data from request]
    *
    * @return redirect route
    */
    public function handleLogin($data)
    {
        $backup = explode("/", Session::get('url.intended'))[3];
        if (Auth::attempt($data)) {
            if (Auth::user()->role->name == Role::ROLE_ADMIN) {
                return redirect()->route('admin.home');
            } elseif ($backup === 'login' || $backup === 'admin' || $backup === '' || $backup === 'activation' || $backup === 'register') {
                return redirect()->route('user.profile');
            }
            return Redirect::to(Session::get('url.intended'));
        } else {
            session()->flash("warning", __('public.login.wrong'));
            return back();
        }
    }
}
