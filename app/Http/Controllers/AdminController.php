<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * The function return home of admin page
     *
     * @return void
     */
    public function home()
    {
        return view('admin.home');
    }
}
