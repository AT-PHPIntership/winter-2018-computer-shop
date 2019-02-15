<?php

namespace App\Services;

use Auth;

class LoginService
{
    /**
    * Get child accessoris
    *
    * @param \Illuminate\Http\Request $data [data from request]
    *
    * @return redirect route
    */
    public function userLogin($data)
    {
        if (Auth::attempt($data)) {
             return Redirect::to(Session::get('url.intended'));
            // return redirect()->route('user.profile');
        } else {
            session()->flash("warning", __('public.login.wrong'));
            return redirect()->back();
        }
        return back();
    }
}
